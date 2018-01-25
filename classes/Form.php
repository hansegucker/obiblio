<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../classes/Localize.php" );
require_once( "../classes/Date.php" );

class Form {
	function getCgi_el( $fields ) {
		$fields = Form::_cleanFields( $fields );
		$errors = array();
		$values = array();
		if ( isset( $_REQUEST['_posted'] ) ) {
			$values['_posted'] = $_REQUEST['_posted'];
		} else {
			$values['_posted'] = false;
		}
		foreach ( $fields as $f ) {
			if ( $f['type'] == 'fixed' ) {
				continue;
			}
			if ( $f['type'] == 'bool' and ( ! isset( $_REQUEST[ $f['name'] ] )
			                                or $_REQUEST[ $f['name'] ] != 'Y' ) ) {
				$_REQUEST[ $f['name'] ] = 'N';
			}
			if ( $f['type'] == 'file' ) {
				if ( isset( $_FILES[ $f['name'] ] ) ) {
					$values[ $f['name'] ] = $_FILES[ $f['name'] ];
				} else {
					$values[ $f['name'] ] = null;
				}
				continue;
			}
			if ( isset( $_REQUEST[ $f['name'] ] ) ) {
				$values[ $f['name'] ] = $_REQUEST[ $f['name'] ];
			} else {
				$values[ $f['name'] ] = $f['default'];
			}
			if ( $f['required'] and $values[ $f['name'] ] == '' ) {
				$errors[] = new FieldOError( $f['name'], Form::T( "This field must be filled in." ) );
				continue;
			}
			if ( $f['type'] == 'select' ) {
				if ( ! isset( $f['options'][ $values[ $f['name'] ] ] ) ) {
					$errors[] = new FieldOError( $f['name'], Form::T( "Choose a valid value from the list." ) );
				}
			} else if ( $f['type'] == 'date' ) {
				list( $val, $err ) = Date::read_e( $values[ $f['name'] ] );
				if ( $err ) {
					$errors[] = new FieldOError( $f['name'], $err->toStr() );
				} else {
					$values[ $f['name'] ] = $val;
				}
			}
		}

		return array( $values, $errors );
	}

	function _cleanFields( $fields ) {
		$defaults = array(
			'name'     => null,
			'title'    => null,
			'type'     => 'text',
			'default'  => '',
			'attrs'    => array(),
			'options'  => array(),
			'label'    => '',
			'required' => false,
		);
		for ( $i = 0; $i < count( $fields ); $i ++ ) {
			$fields[ $i ] = array_merge( $defaults, $fields[ $i ] );
			if ( ! isset( $fields[ $i ]['name'] ) ) {
				Fatal::internalError( Form::T( "No name set for form field." ) );
			}
			if ( ! $fields[ $i ]['title'] ) {
				$fields[ $i ]['title'] = $fields[ $i ]['name'];
			}
		}

		return $fields;
	}

	function T( $msg, $vars = null ) {
		# Kludge to adapt 1.0-pre code to 0.6
		static $loc = null;
		if ( $loc == null ) {
			$loc = new Localize( OBIB_LOCALE, 'classes' );
		}

		return $loc->getText( $msg, $vars );
	}

	function display( $params ) {
		$defaults = array(
			'title'   => '',
			'name'    => null,
			'method'  => 'post',
			'enctype' => null,
			'action'  => null,
			'submit'  => Form::T( 'Submit' ),
			'cancel'  => null,
			'fields'  => array(),
			'values'  => array(),
			'errors'  => array(),
		);
		$params   = array_merge( $defaults, $params );
		if ( ! $params['action'] ) {
			Fatal::internalError( Form::T( "No form action" ) );
		}
		$fields = Form::_cleanFields( $params['fields'] );
		echo "<form method='" . H( $params['method'] ) . "' action='" . H( $params['action'] ) . "'";
		if ( $params['name'] ) {
			echo ' name="' . H( $params['name'] ) . '" id="' . H( $params['name'] ) . '"';
		}
		if ( $params['enctype'] ) {
			echo ' enctype="' . H( $params['enctype'] ) . '"';
		}
		echo ">";
		echo '<input type="hidden" name="_posted" value="1">';
		list( $msg, $errors ) = FieldOError::listExtract( $params['errors'] );
		$rows = array();
		foreach ( $fields as $f ) {
			if ( ! isset( $params['values'][ $f['name'] ] ) ) {
				$f['value'] = $f['default'];
			} else {
				$f['value'] = $params['values'][ $f['name'] ];
			}
			$html = Form::_inputField( $f );
			if ( isset( $errors[ $f['name'] ] ) ) {
				$error = $errors[ $f['name'] ];
			} else {
				$error = null;
			}
			if ( $f['type'] == 'hidden' ) {
				if ( $error ) {
					Fatal::internalError( Form::T( "Unexpected hidden field error: %error%", array( 'OError' => $error ) ) );
				}
				echo $html;
			} else {
				$rows[] = array( 'title' => $f['title'], 'html' => $html, 'OError' => $error, 'name' => $f['name'] );
			}
		}
		echo '<div>';
		echo '<h5>' . H( $params['title'] ) . '</h5>';
		if ( $msg ) {
			echo '<p class="red-text">' . H( $msg ) . '</p>';
		}
		foreach ( $rows as $r ) {
			echo '<label for="' . $r['name'] . '">' . H( $r['title'] ) . '</label>';
			if ( $r['OError'] ) {
				$err = '<p class="red-text">' . H( $r['OError'] ) . '</p>';
			} else {
				$err = '';
			}
			echo $err . $r['html'];
		}
		echo '<button type="submit" class="waves-effect waves-light btn green">' .
		     '<i class="material-icons left">send</i>' . H( $params['submit'] ) . "</button>";
		if ( $params['cancel'] ) {
			echo '<a class="waves-effect waves-light btn red" ' .
			     'href="' . H( $params['cancel'] ) . '">'
			     . '<i class="material-icons left">cancel</i>'
			     . Form::T( "Cancel" ) . '</a> ';
		}
		echo '</div>';
		echo "</form>";
	}

	function _inputField( $field ) {
		$s     = "";
		$attrs = "";
		foreach ( $field['attrs'] as $k => $v ) {
			$attrs .= H( $k ) . '="' . H( $v ) . '" ';
		}
		switch ( $field['type'] ) {
			// FIXME radio
			case 'select':
				$s .= '<div class="input-field">';
				$s .= '<select id="' . H( $field['name'] );
				$s .= '" name="' . H( $field['name'] );
				$s .= ' id="' . H( $field['name'] ) . '" ';
				$s .= '" ' . $attrs . ">\n";
				foreach ( $field['options'] as $val => $desc ) {
					$s .= '<option value="' . H( $val ) . '" ';
					if ( $field['value'] == $val ) {
						$s .= ' selected="selected"';
					}
					$s .= ">" . H( $desc ) . "</option>\n";
				}
				$s .= "</select></div>";
				break;
			case 'textarea':
				$s .= '<div class="input-field">';

				$s .= '<textarea';
				$s .= 'name="' . H( $field['name'] ) . '" ';
				$s .= 'id="' . H( $field['name'] ) . '" ';
				$s .= $attrs . ">" . H( $field['value'] ) . "</textarea></div>";
				break;
			case 'file':
				$s .= '<div class="file-field input-field">';
				$s .= '<div class="btn"><span><i class="material-icons center">file_upload</i></span><input type="file"> </div>';
				$s .= '<div class="file-path-wrapper">';
				$s .= '<input type="text" class="file-path validate" ';
				$s .= 'name="' . H( $field['name'] ) . '" ';
				$s .= 'id="' . H( $field['name'] ) . '" ';
				$s .= $attrs . "></div></div>";
				break;
			case 'bool':
				$s .= '<div class="input-field">';
				$s .= '<input type="checkbox" ';
				$s .= 'name="' . H( $field['name'] ) . '" ';
				$s .= 'value="Y" ';
				$s .= 'id="' . H( $field['name'] ) . '" ';
				if ( $field['value'] == 'Y' ) {
					$s .= 'checked="checked" ';
				}
				$s .= $attrs . "></div>";
				break;
			case 'fixed':
				$s .= H( $field['value'] );
				break;
			case 'date':
				$s .= '<div class="input-field">';
				$s .= '<input type="text" ';
				$s .= 'name="' . H( $field['name'] ) . '" ';
				$s .= 'value="' . H( $field['value'] ) . '" ';
				$s .= 'id="' . H( $field['name'] ) . '" ';
				$s .= $attrs . "></div>";
				break;
			default:
				$s .= '<div class="input-field">';
				$s .= '<input type="' . H( $field['type'] ) . '" ';
				$s .= 'name="' . H( $field['name'] ) . '" ';
				$s .= 'value="' . H( $field['value'] ) . '" ';
				$s .= 'id="' . H( $field['name'] ) . '" ';
				$s .= $attrs . "></div>";
				break;
		}
		if ( $field['label'] ) {
			$s .= ' ' . H( $field['label'] );
		}

		return $s;
	}
}
