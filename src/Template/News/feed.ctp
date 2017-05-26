<?php 
$this->set('channelData', [
    'title' => __("Most Recent News"),
    'link' => $this->Url->build('/', true),
    'description' => __("Most recent News."),
    'language' => 'en-us'
]);
foreach ($articles as $article) {
    $created = strtotime($article->created);

    $link = [
        'controller' => 'News',
        'action' => 'news_view',/* 
        'year' => date('Y', $created),
        'month' => date('m', $created),
        'day' => date('d', $created), */
        'news_view' => $article->slug
    ];

    // Remove & escape any HTML to make sure the feed content will validate.
    $body = h(strip_tags($article->description));
    $body = $this->Text->truncate($body, 400, [
        'ending' => '...',
        'exact'  => true,
        'html'   => true,
    ]);

	
    echo  $this->Rss->item([], [
        'title' => $article->title,
        'link' => $link,
        'guid' => ['url' => $link, 'isPermaLink' => 'true'],
        'description' => html_entity_decode($body),
        'pubDate' => $article->created
    ]);
} ?>