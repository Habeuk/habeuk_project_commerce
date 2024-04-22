<?php

namespace DrupalHabeuk;

use Composer\Script\Event;
use Symfony\Component\Finder\Finder;
use DrupalFinder\DrupalFinder;

/**
 *
 * @author stephane
 *        
 */
class GiveAccessInDirs {
  
  /**
   * Permettre à l'utilisateur www-data de creer les dossiers et les fichiers.
   *
   * @param \Composer\Script\Event $event
   *        Event to echo output.
   */
  public static function GiveAccess(Event $event) {
    $DrupalRoot = static::getPackageRoot();
    $DrupalThemes = $DrupalRoot . "/themes";
    if (file_exists($DrupalThemes)) {
      $DrupalSites = $DrupalRoot . "/sites/default";
      $command = "sudo chmod -R 777 $DrupalThemes";
      $event->getIO()->write(" Running  $command");
      exec($command);
    }
    if (file_exists($DrupalSites)) {
      $command = "sudo chmod -R 777 $DrupalSites";
      $event->getIO()->write(" Running  $command");
      exec($command);
    }
  }
  
  /**
   * Get Package Root.
   *
   * @return string Path to Drupal Root.
   */
  protected static function getPackageRoot() {
    $drupalFinder = new DrupalFinder();
    if ($drupalFinder->locateRoot(getcwd())) {
      return $drupalFinder->getDrupalRoot();
    }
  }
  
}
