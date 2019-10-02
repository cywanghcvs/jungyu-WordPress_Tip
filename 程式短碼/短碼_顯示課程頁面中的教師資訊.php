<?php
//在PHP 程式嵌入短碼語法：do_shortcode('[display_teacher_intro field-name="teacher_list" template="1"]')
add_shortcode('display_teacher_intro', 'display_teacher_intro');

function display_teacher_intro($atts = [], $content = null, $tag = '')
{
    // normalize attribute keys, lowercase
    $atts = array_change_key_case((array) $atts, CASE_LOWER);
    // 取得短碼屬性
    $params = shortcode_atts(array(
        'field-name' => 'teacher_list',
        'template' => '1'
    ), $atts, $tag);

    //須先取得文章物件後，才能取得自訂欄位 repeater 型別的物件
    $the_post = &get_post(get_the_ID());
    if (have_rows($params['field-name'])) {
        foreach (have_rows($params['field-name']) as $sub_field_object) { }
    }

    $fields = get_fields(get_the_ID());
    $repeater = $fields[$params['field-name']];

    foreach ($repeater as $row) {
        foreach ($row as $key => $value) {
            if ($params['template'] == "1") {
                composeTeacherIntro1($value);
            } else {
                composeTeacherIntro2($value);
            }
        }
    }
}

//$value = Post ID (教師資訊)
function composeTeacherIntro1($postId)
{
    $teacherName = get_field("teacher-name", $postId);
    $title = get_field("title", $postId);
    $jobUnit = get_field("job-unit", $postId);
    $jobName = get_field("job-name", $postId);
    $avatarObject = get_field("avatar", $postId);
    $expertie = get_field("expertie", $postId);

    echo '<section class="elementor-element elementor-element-d508bbf elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section" data-id="d508bbf" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
				<div class="elementor-row">
				<div class="elementor-element elementor-element-534e5de elementor-column elementor-col-50 elementor-inner-column" data-id="534e5de" data-element_type="column">
			<div class="elementor-column-wrap  elementor-element-populated">
					<div class="elementor-widget-wrap">
				<div class="elementor-element elementor-element-cdc80ca elementor-widget elementor-widget-heading" data-id="cdc80ca" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<span class="elementor-heading-title elementor-size-default">INSTRUCTORS</span>		</div>
				</div>
				<div class="elementor-element elementor-element-15be6ac elementor-widget elementor-widget-heading" data-id="15be6ac" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">講師介紹</h2>		</div>
				</div>
				<div class="elementor-element elementor-element-77221ee elementor-widget elementor-widget-text-editor" data-id="77221ee" data-element_type="widget" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
					<div class="elementor-text-editor elementor-clearfix"><p>' . $expertie . ' </p></div>
				</div>
				</div>
						</div>
			</div>
		</div>
				<div class="elementor-element elementor-element-e5cfd5a elementor-column elementor-col-50 elementor-inner-column" data-id="e5cfd5a" data-element_type="column">
			<div class="elementor-column-wrap  elementor-element-populated">
					<div class="elementor-widget-wrap">
				<div class="elementor-element elementor-element-d9d4ae3 elementor-widget elementor-widget-image" data-id="d9d4ae3" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
					<div class="elementor-image">
										<img src="' . $avatarObject[url] . '" title="pexels-photo-1036622" alt="pexels-photo-1036622" />											</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-173a245 elementor-widget elementor-widget-heading" data-id="173a245" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h3 class="elementor-heading-title elementor-size-default">' . $teacherName . '</h3>		</div>
				</div>
				<div class="elementor-element elementor-element-4f98110 elementor-widget elementor-widget-heading" data-id="4f98110" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h5 class="elementor-heading-title elementor-size-default">' . $jobUnit . ' ' . $jobName . '</h5>		</div>
				</div>
						</div>
			</div>
		</div>
						</div>
			</div>
		</section>
';
}


function composeTeacherIntro2($postId)
{
    $teacherName = get_field("teacher-name", $postId);
    $title = get_field("title", $postId);
    $jobUnit = get_field("job-unit", $postId);
    $jobName = get_field("job-name", $postId);
    $avatarObject = get_field("avatar", $postId);
    $$expertie = get_field("expertie", $postId);

    echo '<section class="elementor-element elementor-element-0ac0981 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="0ac0981" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
				<div class="elementor-row">
				<div class="elementor-element elementor-element-1dd226c elementor-column elementor-col-33 elementor-top-column" data-id="1dd226c" data-element_type="column">
			<div class="elementor-column-wrap">
					<div class="elementor-widget-wrap">
						</div>
			</div>
		</div>
				<div class="elementor-element elementor-element-15aa355 elementor-column elementor-col-33 elementor-top-column" data-id="15aa355" data-element_type="column">
			<div class="elementor-column-wrap  elementor-element-populated">
					<div class="elementor-widget-wrap">
				<div class="elementor-element elementor-element-0683921 elementor-widget elementor-widget-heading" data-id="0683921" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h4 class="elementor-heading-title elementor-size-default"><br>' . $teacherName . '</h4>		</div>
				</div>
				<div class="elementor-element elementor-element-503f1a8 elementor-widget elementor-widget-heading" data-id="503f1a8" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h5 class="elementor-heading-title elementor-size-default">' . $jobUnit . ' | ' . $jobName . '</h5>		</div>
				</div>
						</div>
			</div>
		</div>
				<div class="elementor-element elementor-element-258c550 elementor-column elementor-col-33 elementor-top-column" data-id="258c550" data-element_type="column">
			<div class="elementor-column-wrap  elementor-element-populated">
					<div class="elementor-widget-wrap">
				<div class="elementor-element elementor-element-6081de3 elementor-widget elementor-widget-image" data-id="6081de3" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
					<div class="elementor-image">
										<img src="' . $avatarObject[url] . '" title="6.潘芷盈老師" alt="6.潘芷盈老師" />											</div>
				</div>
				</div>
						</div>
			</div>
		</div>
						</div>
			</div>
		</section>';
}
