<?php defined('BASEPATH') OR exit('No direct script access allowed');

class BetterHooks {

	
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->hooks =& $this->CI->hooks;
		$this->CI->load->helper('betterhooks');
		//ini_set('display_errors', '1');
	}

	function add_action($action_name, $function_to_call, $priority = 10, $filepath = 'helpers', $filename = 'betterhooks_helper.php') {
		$this->hooks->hooks[$action_name][] = array(
			'filepath' => $filepath,
			'filename' => $filename,
			'class'    => '',
			'function' => $function_to_call,
			'priority' => $priority
		);
	}

	function do_action($action_name, $params = []) {
		if (isset($this->hooks->hooks[$action_name])) {
			//ordenamos los hooks por prioridad
			usort($this->hooks->hooks[$action_name], function($a, $b) {
				return $a['priority'] - $b['priority'];
			});

			//add params set in do_action to each hook
			foreach ($this->hooks->hooks[$action_name] as $key => $hook) {
				$this->hooks->hooks[$action_name][$key]['params'] = $params;
			}

			//print_r($this->hooks->hooks[$action_name]);

			$this->hooks->call_hook($action_name, $params);

		}
	}

	function dump_hooks() {
		echo '<pre>';
		print_r($this->hooks->hooks);
		echo '</pre>';
	}
}