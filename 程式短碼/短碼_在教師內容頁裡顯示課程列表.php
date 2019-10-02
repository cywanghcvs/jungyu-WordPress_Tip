
<?php
//在PHP 程式嵌入短碼語法：do_shortcode('[display_course_in_teacher_info field-name="course-list" subtype="object" subfield="course-name"]')
add_shortcode('display_course_in_teacher_info', 'display_course_in_teacher_info');

function display_course_in_teacher_info($atts = [], $content = null, $tag = '')
{
    // normalize attribute keys, lowercase
    $atts = array_change_key_case((array) $atts, CASE_LOWER);
    // 取得短碼屬性
    $params = shortcode_atts(array(
        'field-name' => 'course-list',
        'subtype' => 'object',
        'subfield' => 'course-name'
    ), $atts, $tag);

    //須先取得文章物件後，才能取得自訂欄位 repeater 型別的物件
    $the_post = &get_post(get_the_ID());
    if (have_rows($params['field-name'])) {
        foreach (have_rows($params['field-name']) as $sub_field_object) { }
    }

    $fields = get_fields(get_the_ID());
    $repeater = $fields[$params['field-name']];

    $fieldValues = array();
    echo '<ul>';
    if ($params['subtype'] == 'object') {
        foreach ($repeater as $row) {
            //array_push($fieldValues, get_the_title($row[$params['subfield']])); 
            echo '<li>' . get_the_title($row[$params['subfield']]) . '</li>';
        }
    } else {
        array_push($fieldValues, $row[$params['subfield']]);
    }
    echo '</ul>';

    //print_r( implode(', ', $fieldValues));

}
