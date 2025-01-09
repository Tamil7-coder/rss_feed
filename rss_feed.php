<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RSS Feed with Images</title>
<style>
body {
font-family: 'Arial', sans-serif;
background-color: #f4f4f9;
color: #333;
margin: 0;
padding: 0;
}

.container {
max-width: 1200px;
margin: 40px auto;
padding: 0;
}

h1 {
font-size: 28px;
text-align: center;
color: #007BFF;
margin-bottom: 40px;
text-transform: uppercase;
letter-spacing: 2px;
}

.news-item {
margin-bottom: 50px;
border-radius: 10px;
overflow: hidden;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.news-image {
width: 100%;
height: auto;
}

.news-content {
padding: 20px;
background: #fff;
}

.news-title {
font-size: 24px;
font-weight: bold;
color: #007BFF;
text-decoration: none;
margin-bottom: 10px;
display: inline-block;
}

.news-title:hover {
color: #0056b3;
}

.news-description {
font-size: 18px;
color: #555;
margin: 15px 0;
}

.news-date {
font-size: 16px;
color: #aaa;
}
</style>
</head>
<body>
<div class="container">
<?php
// RSS Feed URL
$rss_feed_url = "https://feeds.bbci.co.uk/news/world/rss.xml"; 
// Load the RSS feed
$feed = simplexml_load_file($rss_feed_url);
// Check if the feed was loaded successfully
if ($feed) {
echo "<h1>" . $feed->channel->title . "</h1>";
// Loop through each feed item
foreach ($feed->channel->item as $item) {
echo "<div class='news-item'>";
// Display image
$image_url = "";
// Check for image in <enclosure> tag
if (isset($item->enclosure) && $item->enclosure['type'] == "image/jpeg") {
$image_url = $item->enclosure['url'];
}
// Check for image in <media:content> tag
$media = $item->children('media', true);
if ($media->content) {
$image_url = $media->content->attributes()->url;
}
// Check for image in <media:thumbnail> tag
if ($media->thumbnail) {
$image_url = $media->thumbnail->attributes()->url;
}
if ($image_url) {
echo "<img class='news-image' src='$image_url' alt='News Image'>";
}
echo "<div class='news-content'>";
echo "<a class='news-title' href='" . $item->link . "' target='_blank'>" . $item->title . "</a>";
echo "<p class='news-description'>" . $item->description . "</p>";
echo "<span class='news-date'>Published on: " . $item->pubDate . "</span>";
echo "</div>";
echo "</div>";
}
} else {
echo "<h1>Error: Unable to load RSS feed.</h1>";
}
?>
</div>
</body>
</html>




