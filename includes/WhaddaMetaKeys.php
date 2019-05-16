<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WhaddaVars
 *
 * @author lucio
 */
class WhaddaMetaKeys
{
  public static $prefix;
  public static $numberOfColumns;
  public static $numberOfRows;
  
  public function __construct()
  {
    self::$prefix = "whadda_";
    self::$numberOfColumns = self::$prefix."ncols";
    self::$numberOfRows = self::$prefix."rows";
    
  }
}
 new WhaddaMetaKeys();