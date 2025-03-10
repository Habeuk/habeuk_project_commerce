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
    $DrupalSites = $DrupalRoot . "/sites/default";
    if (file_exists($DrupalThemes)) {
      $command = "sudo chmod -R 777 $DrupalThemes";
      $event->getIO()->write(" Running  $command");
      exec($command);
    }
    if (file_exists($DrupalSites)) {
      $command = "sudo chmod -R 777 $DrupalSites";
      $event->getIO()->write(" Running  $command");
      exec($command);
    }
    static::CreateTheme($event);
  }
  
  /**
   * Cree les fichiers du theme habeuk_theme.
   */
  public static function CreateTheme(Event $event) {
    $DrupalRoot = static::getPackageRoot();
    $themeDir = $DrupalRoot . "/themes/custom/habeuk_theme";
    if (!file_exists($themeDir)) {
      $command = "sudo mkdir -p $themeDir";
      exec($command);
      // creation du fichier habeuk_theme.info.yml
      $command = "sudo touch $themeDir/habeuk_theme.info.yml";
      exec($command);
      /**
       * ajouter du contenu dans le fichier habeuk_theme.info.yml
       */
      $content = '
name: habeuk_theme
type: theme
description: " Theme Generate by generate_style_theme "
core_version_requirement: ^9 || ^10
base theme: wb_universe
          
regions:
  top_header: "Top header"
  header: "header"
  hero_slider: "Hero slider"
  sidebar_left: "Sidebar left"
  sidebar_right: "Sidebar right"
  before_content: "beforeContent"
  content: "content"
  after_content: "afterContent"
  call_to_action: "Call to action"
  footer: "Footer"
  hide_content : "Hide content"
          
# Ajout des librairies
libraries:
  - habeuk_theme/vendor-style
  - habeuk_theme/global-style
# Supprimer les librairies du themes parent.
libraries-override:
  wb_universe/global-style: false
';
      // On doit ajouter les doits au fichiers
      $command = "sudo chmod 777 $DrupalRoot/themes/custom/habeuk_theme/habeuk_theme.info.yml";
      exec($command);
      file_put_contents($themeDir . '/habeuk_theme.info.yml', $content);
      $event->getIO()->write(" Running  creation des fichiers du theme habeuk_theme");
      // On donne les droits d'acces au dossier du theme.
      $command = "sudo chmod -R 777 $DrupalRoot/themes/custom";
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

