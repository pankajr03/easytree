<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>EasyTree - Free jquery tree menu</title>
    <meta name="keywords" content="EasyTree free jquery tree menu js javascript" />
    <meta name="description" content="EasyTree, free jquery tree menu" />
    <script src="jquery.js" type="text/javascript"></script>
	<script src="jquery-migrate-1.2.1.js" type="text/javascript"></script>
	<script src="jquery.easytree.js"></script>
	<link href="skin-xp/ui.easytree.css" rel="stylesheet" class="skins" type="text/css" />
	<style>
	.add_blue_background {
		background-color:blue;
		cursor:pointer;
	}
	.add_white_background {
		background-color:white;
		cursor:pointer;
	}
	.div_left_first {
		width:250px;
		float:left; 
		height:300px; 
		overflow:scroll;
	}
	.greater_less_icon {
		padding-bottom:20px;
		font-size:75px;
		cursor:pointer;
	}
	.middle_40 {
		width:40px;
		float:left;
		margin:0; 
		text-align:center;
	}
	</style>
</head>
<body>

	<h2>Image Management. </h2><br />
	<div style="width: 600px;">
		<div class="div_left_first" > 
			<div id="demo1_menu">
				<ul>
					<li class="isFolder isExpanded">2015
						<ul>
							<li class="isFolder isExpanded">Terrorism
								<ul>
									<li class="isFolder isExpanded">nextarget
										<ul>
											<li>nextarget.pdf</li>
											<li>nextarget_lrg.jpg</li>
											<li>nextarget_tn.jpg</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</li>

					<li class="isFolder isExpanded">2009
						<ul>
							<li class="isFolder isExpanded">Terrorism
								<ul>
									<li class="isFolder isExpanded">nextarget
										<ul>
											<li>nextarget.pdf</li>
											<li>nextarget_lrg.jpg</li>
											<li>nextarget_tn.jpg</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</li>

				</ul>
			
			</div>
		</div>
		
		<div class="middle_40">

			<div class="greater_less_icon" id="left_to_right">&raquo; </div>
			<div style="height:20px;"></div>
			<div class="greater_less_icon" id="right_to_left">&laquo;</div>

		</div>

		<div class="div_left_first">
			<div id="demo2_menu">
				<ul>
				</ul>
			</div>

		</div>

	</div>
	<input type="hidden" id="right_hidden_value" name="right_hidden_value">
	<input type="hidden" name="txt_hold_images_array[]" /> 

	<script type="text/javascript">
	var hold_images_array = new Array();
    var crt_li_unqiue_id = 0;
	var g_demo2_menu_li_id = 0 ;
	var right_node_click = 0 ;
	var left_node_click = 0 ;
            			
	var easyTree1 = jQuery('#demo1_menu').easytree({
		enableDnd: true,

	});
            
	jQuery(document).ready(function(){

		jQuery('input[name="txt_hold_images_array[]"]').val(hold_images_array) ; 

		/**
		 * in_array function in javascript
		 */
		function index_elt_val( find_elm ) {
			var found_elm = 0 ; 
			jQuery.each(hold_images_array, function(key, value ) {
				console.log(value);
				console.log(find_elm);
				if (find_elm == value )  {
					found_elm = 1 ; 
					return false;
				}
				
			});
			return found_elm;
		}

		/**
		 * all the li background will be white.
		 */
		function list_of_ul(){
			jQuery('#demo2_menu ul li').each(function(i)
			{
			   jQuery(this).attr('class', "add_white_background");
			});
		}

		jQuery("#right_to_left").live("click", function() {
			
			var s_demo_menu_ul = '#demo2_menu ul li#'+g_demo2_menu_li_id ;
			var id_sel = jQuery(s_demo_menu_ul).text() ; 

			if ( id_sel == '' ) {
				alert ('Please select the element from the right hand side') ; 
			} else {
				
				var s_demo_menu_ul = '#demo2_menu ul li#'+g_demo2_menu_li_id ;
				var id_sel = jQuery(s_demo_menu_ul).text() ; 
				addNode(id_sel);
				hold_images_array.pop(id_sel);
				jQuery(s_demo_menu_ul).remove(); 
				jQuery('input[name="txt_hold_images_array[]"]').val(hold_images_array) ; 
			}
		});

		jQuery("#left_to_right").live("click",function() {
			
			var j_val = jQuery("#right_hidden_value").val() ; 

			if ( j_val == '' )  {
				alert ('Please select the element from the left hand side') ; 
				exit();
			}
			crt_li_unqiue_id++;
			
			var j_t_f = index_elt_val(j_val);
			
			if ( j_t_f == 0 ) {
				hold_images_array.push(j_val);
				jQuery('input[name="txt_hold_images_array[]"]').val(hold_images_array) ; 
				jQuery("#demo2_menu ul").append('<li id=\'ri_'+crt_li_unqiue_id+'\' class=\'add_white_background\' style=\'cursor:pointer\'>'+j_val+'</li>');

			} else {
				alert ('Move element already exist!') ; 
			}

		});


		jQuery("#demo2_menu li").live("click", function() {
			var current_class = jQuery(this).attr('class');
			list_of_ul();

			if ( current_class == 'add_blue_background' ) {
				jQuery(this).attr("class", "add_white_background");
				right_node_click = 0;
			} else {
				right_node_click = 1;
				console.log( jQuery(this).text() ) ;
				g_demo2_menu_li_id = jQuery(this).attr("id");
				jQuery(this).attr("class", "add_blue_background");
			}

		});


		jQuery("#demo1_menu li span.easytree-title").live("click", function(e){
			e.preventDefault();
			var collected_folder_array = new Array();
			var current_selected_text = jQuery(this).text()

			jQuery( jQuery(this).parents("li").find('.easytree-ico-ef') ).each(function(){
				collected_folder_array.push(jQuery(this).text());
			});

			var energy = "hatecd/"+collected_folder_array.join("/")+"/"+current_selected_text;
			jQuery("#right_hidden_value").val(energy); 
			
		});

		function addNode( id_sel ) {
			var j_val = id_sel ; 
			var j_val_arr = j_val.split('/');
			j_val_filter = j_val_arr[j_val_arr.length-1];
			
			var sourceNode = {};
			sourceNode.text = j_val_filter;
			sourceNode.isFolder = '';
			var targetId = '';
			easyTree1.addNode(sourceNode, targetId);
			easyTree1.rebuildTree();
		}

	});

	</script>

	</body>
</html>