<?php
class Template {
  private $data;
    /*
     * Wrapper for smarty
     */
  public static function render($template, $data = []) {
    $smarty = new Smarty();
		$smarty->setTemplateDir('../view');
		$smarty->setCompileDir('../view/compiled');

    foreach ($data as $key => $value)
      $smarty->assign($key, $value);

    $smarty->display($template);
  }
}
