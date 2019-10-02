<?php
//在PHP 程式嵌入短碼語法：do_shortcode('[display_acf_repeater field-name="education" with-id="true"]')
add_shortcode('display_acf_repeater', 'display_acf_repeater');

function display_acf_repeater($atts = [], $content = null, $tag = '')
{
    // normalize attribute keys, lowercase
    $atts = array_change_key_case((array) $atts, CASE_LOWER);
    // 取得短碼屬性
    $params = shortcode_atts(array(
        'field-name' => 'education',
        'with-id' => 'true'
    ), $atts, $tag);

    //須先取得文章物件後，才能取得自訂欄位 repeater 型別的物件
    $the_post = &get_post(get_the_ID());
    if (have_rows($params['field-name'])) {
        foreach (have_rows($params['field-name']) as $sub_field_object) { }
    }

    $fields = get_fields(get_the_ID());
    $repeater = $fields[$params['field-name']];

    $showTableHead = true;
    $index = 1;
    echo '<table>';
    if ($showTableHead) {
        echo '<tr>';
        if ($params['with-id'] == 'true') {
            echo '<td> No. </td>';
        }
        foreach ($repeater as $row) {
            foreach ($row as $key => $value) {
                //取得 repeater 型別的物件內之子欄位物件
                $field_object = get_sub_field_object($key);
                echo '<th>' . $field_object['label'] . '</th>';
            }
			break;
        }
        echo '</tr>';
        $showTableHead = false;
    }
    if (!$showTableHead) {
        foreach ($repeater as $row) {
            echo '<tr>';
            if ($params['with-id'] == 'true') {
                //echo $params['with-id'];
                echo '<td>' . $index . '.</td>';
            }
            foreach ($row as $key => $value) {
				if(gettype($value) == 'string'){
                	echo '<td>' .  $value . '</td>';
				} else if(gettype($value) == 'array') {
					echo '<td>' .  implode(',', $value) . '</td>';
				}
            }
            $index++;
            echo '</tr>';
        }
    }
    echo '</table>';
}

    }
    echo '</table>';
}
