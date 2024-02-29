<?php
namespace Core;

class Viewer {
  public function render($fileName, array $data = []) {
    extract($data, EXTR_SKIP);
    require "Views/$fileName";
  }
}