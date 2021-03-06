<?php
/**
 * The class to register, update and display blocks
 *
 * It provides an easy API for people to add their own blocks
 * to the Aqua Page Builder
 *
 * @package Aqua Page Builder
 */

$aq_registered_blocks = array();

if(!class_exists('AQ_Block')) {
	class AQ_Block {
		 
		//some vars
		var $id_base;
		var $block_options;
		var $instance;
		/* PHP5 constructor */
		function __construct($id_base = false, $block_options = array()) {
			$this->id_base = isset($id_base) ? strtolower($id_base) : strtolower(get_class($this));
			$this->name = isset($block_options['name']) ? $block_options['name'] : ucwords(preg_replace("/[^A-Za-z0-9 ]/", '', $this->id_base));
			$this->block_options = $this->parse_block($block_options);
		}

		/* PHP4 constructor */
		function AQ_Block($id_base = false, $block_options = array()) {
			AQ_Block::__construct($id_base, $block_options);
		}
		 

		 
		/**
		 * Block - display the block on front end
		 *
		 * Sub-class MUST override this or it will output an error
		 * with the class name for reference
		 */
		function block($instance) {
			extract($instance);
			echo __('function AQ_Block::block should not be accessed directly. Output generated by the ', 'framework') . strtoupper($id_base). ' Class';
		}
		 
		/**
		 * The callback function to be called on blocks saving
		 *
		 * You should use this to do any filtering, sanitation etc. The default
		 * filtering is sufficient for most cases, but nowhere near perfect!
		 */
		function update($new_instance, $old_instance) {
			$new_instance = array_map('htmlspecialchars', array_map('stripslashes', $new_instance));
			return $new_instance;
		}
		 
		/**
		 * The block settings form
		 *
		 * Use subclasses to override this function and generate
		 * its own block forms
		 */
		function form($instance) {
			echo '<p class="no-options-block">' . __('There are no options for this block.', 'framework') . '</p>';
			return 'noform';
		}
		 
		/**
		 * Form callback function
		 *
		 * Sets up some default values and construct the basic
		 * structure of the form. Unless you know exactly what you're
		 * doing, DO NOT override this function
		 */
		function form_callback($instance = array()) {
			//insert block options into instance
			$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
            array_str_replace(";cbsp#21;","\r\n",$instance);
			//insert the dynamic block_id
			$this->block_id = 'aq_block_' . $instance['number'];
			$instance['block_id'] = $this->block_id;

			//display the block
			$this->before_form($instance);
			$this->form($instance);
			$this->after_form($instance);
		}
		 
		/**
		 * Block callback function
		 *
		 * Sets up some default values. Unless you know exactly what you're
		 * doing, DO NOT override this function
		 */
		function block_callback($instance) {
			//insert block options into instance
			$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
            array_str_replace(";cbsp#21;","\r\n",$instance);
			//insert the dynamic block_id
			$this->block_id = 'aq_block_' . $instance['number'];
			$instance['block_id'] = $this->block_id;

			//display the block
			$this->before_block($instance);
			$this->block($instance);
			$this->after_block($instance);
		}
		function block_callback_return($instance) {
			return 'lol-';
		}
		 
		/* assign default block options if not yet set */
		function parse_block($block_options) {
			$defaults = array(
	 			'id_base' => $this->id_base,	//the classname
	 			'order' => 0, 					//block order
	 			'name' => $this->name,			//block name
	 			'size' => 'span12',				//default size
	 			'title' => '',					//title field
	 			'parent' => 0,					//block parent (for blocks inside columns)
	 			'number' => '__i__',			//block consecutive numbering
	 			'first' => false,				//column first
	 			'resizable' => 1,				//whether block is resizable/not
			);

			$block_options = is_array($block_options) ? wp_parse_args($block_options, $defaults) : $defaults;

			return $block_options;
		}
		 
		function before_form($instance) {
			extract($instance);

			$title = $title ? '<span class="in-block-title"> : '.$title.'</span>' : '';
			$resizable = $resizable ? '' : 'not-resizable';
if(!isset($fader)) $fader='';
$block_saving_id = 'aq_blocks[aq_block_'.$number.']';
$cols_o=array(''=>'--select effect--','fadein'=>'Fade','slideleft'=>'Slide Left','slideright'=>'Slide Right','slidetop'=>'Slide Top','slidedown'=>'Slide Down');

			echo '<li id="template-block-'.$number.'" class="block block-'.$id_base.' '. $size .' '.$resizable.'">',
	 				'<div class="block-bar">',
	 					'<div class="block-handle"><div class="select_size"><span class="selected_size s_'. $size .'" >
	 				<i class="fa fa-arrows-h"></i></span>',
                '<div class="size"><ul>
                <li class="s_span12'.(($size=='span12')?' sel_size':'').'">100%</li>
                <li class="s_span11'.(($size=='span11')?' sel_size':'').'">92%</li>
                <li class="s_span10'.(($size=='span10')?' sel_size':'').'">83%</li>
                <li class="s_span9'.(($size=='span9')?' sel_size':'').'">75%</li>
                <li class="s_span8'.(($size=='span8')?' sel_size':'').'">67%</li>
                <li class="s_span7'.(($size=='span7')?' sel_size':'').'">58%</li>
                <li class="s_span6'.(($size=='span6')?' sel_size':'').'">50%</li>
                <li class="s_span5'.(($size=='span5')?' sel_size':'').'">42%</li>
                <li class="s_span4'.(($size=='span4')?' sel_size':'').'">33%</li>
                <li class="s_span3'.(($size=='span3')?' sel_size':'').'">25%</li>
                <li class="s_span2'.(($size=='span2')?' sel_size':'').'">17%</li>
                </ul></div></div>',
	 						'<div class="block-title">',
			$name , $title,
	 						'</div>',
            '<div class="block-controls">
            ';

            if(!isset($preview)) $preview=''; if($preview==1)
                echo '<a class="block-preview" id="preview-'.$number.'" title="Preview" href="#aq_block_'.$number.'_preview"><i class="fa fa-chevron-down"></i></a> ';

            if(!isset($show_editor)) $show_editor='';
            if($show_editor==1)
               echo '<a class="block-editor" id="editor-'.$number.'" title="Open Editor" href="javascript:WPEditorWidget.showEditor(\''.$block_id .'\');void(0);"><i class="fa fa-pencil"></i></a> ';
            if($show_editor==2)
                echo '<a class="block-editor" id="editor-'.$number.'" title="Open Editor" href="javascript:WPEditorWidget.showEditor(\''.$block_id .'_editor\');void(0);"><i class="fa fa-pencil"></i></a> ';
            if(!isset($options)) $options=1;
            if($options==1)
                echo '<a class="block-options" id="options-'.$number.'" title="Block Options" href="#block-options-'.$number.'"><i class="fa fa-gear"></i></a>';
            echo '','',
	 							'<a href="#" class="delete del-icon"  title="Delete"><i class="fa fa-times"></i></a>',
	 						'</div>',
	 					'</div>',
	 				'</div>';
            if($preview==1) echo '<div class="prev-block" id="aq_block_'.$number.'_preview" style="display:none;"></div>';
	 				echo '<div class="block-settings cf" >';
                    echo '<div class="inside-options" style="display: none;">';
                    ?>
                    <script type="text/javascript">
                    jQuery(document).ready(function($){
                    	
                        jQuery('.cb_hint').hover(
                        function(){
                        	jQuery('.hint',this).stop().show();
                        },function(){
                        	jQuery('.hint',this).stop().hide();
                        });
                    });
                    </script><?php

		}
		 
		//form footer
		function after_form($instance) {

            extract($instance);


    echo '<button type="button" onclick="tb_remove();" class="button cb_button_save button-primary">'.__('Save changes','cb-modello').'</button>';
	echo '<input type="hidden" class="id_base" name="'.$this->get_field_name('id_base').'" value="'.$id_base.'" />';
	echo '<input type="hidden" class="name" name="'.$this->get_field_name('name').'" value="'.$name.'" />';
	echo '<input type="hidden" class="order" name="'.$this->get_field_name('order').'" value="'.$order.'" />';
	echo '<input type="hidden" class="size" name="'.$this->get_field_name('size').'" value="'.$size.'" />';
	echo '<input type="hidden" class="parent" name="'.$this->get_field_name('parent').'" value="'.$parent.'" />';
	echo '<input type="hidden" class="number" name="'.$this->get_field_name('number').'" value="'.$number.'" />';
	echo '</div>',
	 			'</li>';
		}
		 
		/* block header */
		function before_block($instance) {
			extract($instance); 
			if(!isset($fader)) $fader='';
			if(!isset($fullw)) $fullw='';
			$column_class = $first ? 'aq-first' : '';
			$fader_class = $fader ? 'animatefade-'.$fader : '';
			if($fullw=='yes')$fully_class = 'fullwidth_block'; else $fully_class='';
			echo '<div id="aq-block-'.$template_id.'-'.$number.'" class="aq-block aq-block-'.$id_base.' aq_'.$size.' '.$column_class.' '.$fader_class.' '.$fully_class.' cf">';
		}
		 
		/* block footer */
		function after_block($instance) {
			extract($instance);
			echo '</div>';
		}
		 
		function get_field_id($field) {
			$field_id = isset($this->block_id) ? $this->block_id . '_' . $field : '';
			return $field_id;
		}
		 
		function get_field_name($field) {
			$field_name = isset($this->block_id) ? 'aq_blocks[' . $this->block_id. '][' . $field . ']': '';
			return $field_name;
		}
		 
	}
}