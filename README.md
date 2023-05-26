# Codeigniter Better Hooks
A better hooks system for codeigniter

## Installation
- Merge this repository application folder with your application folder.
- Load BetterHooks library in your autoload.php.

## Usage
### add_action()
Creates a hook in the system. The hook will be executed when the hook is called by **do_action()**.


```php
add_action('action_tag', 'callback_function', [priority], [file_path], [file_name]);
```
- **action_tag** (string) (required) The name of the action to which the $callback_function is hooked.
- **callback_function** (callable) (required) The name of the function you wish to be called when do_action() is called.
- **priority** (int) (optional) Used to specify the order in which the functions associated with a particular action are executed. Lower numbers correspond with earlier execution, and functions with the same priority are executed in the order in which they were added to the action.
- **file_path** (string) (optional) The path to the file containing the callback function.
- **file_name** (string) (optional) The name of the file containing the callback function.

 *Note: By default, filepath points to helpers folder and filename points to betterhooks_helper.php, but you can create new helper files.
 This helper files must load the BetterHooks library:
```php
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$CI->load->library('betterhooks');

// Your code here
```

Then you must specify the path and filename when adding the action.*

### do_action()
Executes the callback functions that have been added to an action hook.

```php
do_action('action_tag', [params]);
```
- **action_tag** (string) (required) The name of the action to be executed.

- **params** (array) (optional) The parameters to be passed to the callback functions.

### An example of use
```php
// application/helpers/betterhooks_helper.php or another helper file
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$CI->load->library('betterhooks');

// Add action
$CI->betterhooks->add_action('after_main_menu_items_loaded', 'add_menu_item', 10);

// Callback function to add new menu item
function add_menu_item() {
	echo '
	<li><a href="#">New menu item 1</a></li>
	<li><a href="#">New menu item 2</a></li>
	<li><a href="#">New menu item 3</a></li>';
}
```

Then in your view file:
```php
<ul class="menu" id="main_menu">
	<li><a href="#">Core Menu item 1</a></li>
	<li><a href="#">Core Menu item 2</a></li>
	<li><a href="#">Core Menu item 3</a></li>
	<?php $CI->betterhooks->do_action('after_main_menu_items_loaded'); ?>
</ul>
```

This will result in:
```html
<ul class="menu" id="main_menu">
	<li><a href="#">Core Menu item 1</a></li>
	<li><a href="#">Core Menu item 2</a></li>
	<li><a href="#">Core Menu item 3</a></li>
	<li><a href="#">New menu item 1</a></li>
	<li><a href="#">New menu item 2</a></li>
	<li><a href="#">New menu item 3</a></li>
</ul>
```
