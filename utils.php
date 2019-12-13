<?php

/*
Responsable de récupérer le code HTML final de la view
*/
function getView($view, $datas, $withAlert = null, $withReplace = null)
{
  if (isset($withAlert)) {
    $replace = isset($withReplace) ? "window.location.replace('" . $withReplace . "');" : "";
    $script = '<script> alert("' . $withAlert . '"); ' . $withReplace . '</script>';
  }
  ob_start();
  include($view);
  $file_content = ob_get_clean();
  return $file_content;
}

/*
Place la view au milieu du template
*/
function loadTemplate($content, $title, $css_files = null) {
  require("view/templates/template.php");
}
function loadTemplateMember($content, $title, $css_files = null) {
  require("view/templates/templateMember.php");
}
function loadTemplateAdmin($content, $title, $css_files = null) {
  require("view/templates/templateAdmin.php");
}
