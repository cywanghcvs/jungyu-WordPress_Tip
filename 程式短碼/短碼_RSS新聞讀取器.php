<?php
//校園搶先報-秘書室
//http://www.npust.edu.tw/xml_file/b01.xml
//嵌入短碼語法：[rss_list url="http://www.npust.edu.tw/xml_file/" id="b01" suffix=".xml" limit="10" len="36"]
//limit 筆數, len 標題裁切長度
/* css 手動加入
.elementor-icon-list-item {
    line-height: 1.8rem;
    border-bottom: 1px dotted #eeeeee;
}
*/

add_shortcode('rss_list', 'rss_list');
function rss_list($atts = [], $content = null, $tag = '')
{
    // normalize attribute keys, lowercase
    $atts = array_change_key_case((array) $atts, CASE_LOWER);
    // 取得短碼屬性
    $params = shortcode_atts(array(
        'url' => 'ttp://www.npust.edu.tw/xml_file/',
        'id' => 'b01',
        'suffix' => '.xml',
        'limit' => '10',
        'len' => '36'
    ), $atts, $tag);

    $rss = new DOMDocument();
    $rss->load($params['url'] . $params['id'] . $params['suffix']);
    $feed = array();
    foreach ($rss->getElementsByTagName('item') as $node) {
        $item = array(
            'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
            'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
            'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
            'pubDate' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
            'endDate' => $node->getElementsByTagName('endDate')->item(0)->nodeValue,
            'guid' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
            'type' => $node->getElementsByTagName('type')->item(0)->nodeValue,
            'unit' => $node->getElementsByTagName('unit')->item(0)->nodeValue,
        );
        array_push($feed, $item);
    }
    $limit = $params['limit'];

    echo '
    <div class="elementor-element elementor-icon-list--layout-traditional elementor-widget elementor-widget-icon-list"
        data-id="b63f7ca" data-element_type="widget" data-widget_type="icon-list.default">
        <div class="elementor-widget-container">
            <ul class="elementor-icon-list-items">';
    for ($i = 0; $i < $limit; $i++) {
        $fullTitle = str_replace(' & ', ' &amp; ', $feed[$i]['title']);
        $title = mb_substr($fullTitle, 0, $params['len'], "utf-8");
        if (mb_strlen($fullTitle, 'UTF-8') > $params['len']) $title .= '...';

        $link = $feed[$i]['link'];
        $description = $feed[$i]['desc'];
        $pubDate = date('Y-m-d', strtotime($feed[$i]['pubDate']));
        $endDate = date('Y-m-d', strtotime($feed[$i]['endDate']));
        $guid = $feed[$i]['guid'];
        $type = $feed[$i]['type'];
        $unit = $feed[$i]['unit'];

        echo '<li class="elementor-icon-list-item rss-li">
                    <span class="elementor-icon-list-icon">
                        <i aria-hidden="true" class="fas fa-chevron-right"></i> </span>
                    <span class="elementor-icon-list-text">' . $pubDate . '</span>
					<span class="elementor-icon-list-text">&nbsp;&nbsp;' . $type . '</span>
					<span class="elementor-icon-list-text">&nbsp;&nbsp;' . '<a href="' . $link . '" target="_blank" title="' . $title . '">' . $title . '</a></span>
                </li>';
    }
    echo '</ul></div></div>';
}
