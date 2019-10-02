<?php
//在PHP 程式嵌入短碼語法：do_shortcode('[display_download_repeater field-name="download_list" type="table"]')
add_shortcode('display_download_repeater', 'display_download_repeater');

function display_download_repeater($atts = [], $content = null, $tag = '')
{
    // normalize attribute keys, lowercase
    $atts = array_change_key_case((array) $atts, CASE_LOWER);
    // 取得短碼屬性
    $params = shortcode_atts(array(
        'field-name' => 'download_list',
        'type' => 'table'
    ), $atts, $tag);

    //須先取得文章物件後，才能取得自訂欄位 repeater 型別的物件
    $the_post = &get_post(get_the_ID());
    if (have_rows($params['field-name'])) {
        foreach (have_rows($params['field-name']) as $sub_field_object) { }
    }

    $fields = get_fields(get_the_ID());
    $repeater = $fields[$params['field-name']];

    if ($params['type'] == 'table') {

        $showTableHead = true;
        $index = 1;
        echo '<table>';
        foreach ($repeater as $row) {
            if ($showTableHead) {
                echo '<th>';
                foreach ($row as $key => $value) {
                    //取得 repeater 型別的物件內之子欄位物件
                    $field_object = get_sub_field_object($key);
                    echo '<td>' . $field_object['label'] . '</td>';
                }
                echo '</th>';
                $showTableHead = false;
            }
            if (!$showTableHead) {
                echo '<tr>';
                echo '<td>' . $index . '.</td>';
                foreach ($row as $key => $value) {
                    if ($value['type'] == 'application' || $value['type'] == 'image' || $value['type'] == 'text') {
                        $extension = strtolower(end(explode(".", $value['filename'])));
                        echo '<td>';
                        echo composeButtonByFileType($extension, $value['url'], $value['filename']);
                        echo '</td>';
                    } else {
                        echo '<td>' . $value . '</td>';
                    }
                }
                echo '</tr>';
                $index++;
            }
        }
        echo '</table>';
    } else {
        foreach ($repeater as $row) {
            foreach ($row as $key => $value) {
                if ($value['type'] == 'application' || $value['type'] == 'image' || $value['type'] == 'text') {
                    $extension = strtolower(end(explode(".", $value['filename'])));
                    echo composeButtonByFileType($extension, $value['url'], $value['filename']);
                    //echo '<br />';
                } else {
                    //echo $value. '<br />';
                }
            }
        }
    }
}

function composeButtonByFileType($extension, $url, $filename)
{
    $fontAwesomeClass = getFontAwesome($extension);
    $iconcolorCode = getIconColor($extension);
    return '<div class="elementor-button-wrapper" >
			<a href="' . $url . '" class="elementor-button-link elementor-button elementor-size-md" role="button" 
			style="background-color:rgba(255,255,255,0);color: #000000;" >
				<span class="elementor-button-content-wrapper">
					<span class="elementor-button-icon elementor-align-icon-left">
						<i aria-hidden="true" class="fas ' . $fontAwesomeClass . '" style="color:' . $iconcolorCode . '" ></i>
					</span>
					<span class="elementor-button-text">' . $filename . '</span>
				</span>
			</a>
			</div>';
}

function getFontAwesome($extension)
{
    $result = 'fa-download';
    $fontAwesomeClasses = [
        'pdf'  => 'fa-file-pdf',
        'jpg'  => 'fa-file-image',
        'jpeg' => 'fa-file-image',
        'png'  => 'fa-file-image',
        'svg'  => 'fa-file-image',
        'ppt'  => 'fa-file-powerpoint',
        'pptx' => 'fa-file-powerpoint',
        'pptm' => 'fa-file-powerpoint',
        'csv'  => 'fa-file-csv',
        'xlsx' => 'fa-file-excel',
        'xlsm' => 'fa-file-excel',
        'xls'  => 'fa-file-excel',
        'doc'  => 'fa-file-word',
        'docm' => 'fa-file-word',
        'docx' => 'fa-file-word',
        'odt'  => 'fa-file-word',
        'rtf'  => 'fa-file-word',
        'txt'  => 'fa-file-word',
        'zip'  => 'fa-file-archive',
        'xml'  => 'fa-file-code'
    ];
    if ($fontAwesomeClasses[$extension])
        $result = $fontAwesomeClasses[$extension];

    return $result;
};
function getIconColor($extension)
{
    $result = '#000000';
    $iconcolorCode = [
        'pdf'  => '#FF0000',
        'jpg'  => '#FF0000',
        'jpeg' => '#FF0000',
        'png'  => '#FF0000',
        'svg'  => '#FF0000',
        'ppt'  => '#FF0000',
        'pptx' => '#FF0000',
        'pptm' => '#FF0000',
        'csv'  => '#FF0000',
        'xlsx' => '#FF0000',
        'xlsm' => '#FF0000',
        'xls'  => '#FF0000',
        'doc'  => '#FF0000',
        'docm' => '#FF0000',
        'docx' => '#FF0000',
        'odt'  => '#FF0000',
        'rtf'  => '#FF0000',
        'txt'  => '#FF0000',
        'zip'  => '#FF0000',
        'xml'  => '#FF0000',
    ];
    if ($iconcolorCode[$extension])
        $result = $iconcolorCode[$extension];

    return $result;
};
