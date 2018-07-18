<?php

namespace Drupal\dandecrosswords\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\file\Plugin\Field\FieldFormatter\FileFormatterBase;

/**
 * Plugin implementation of the 'crossword_puzzle' formatter.
 *
 * @FieldFormatter(
 *   id = "crossword_puzzle",
 *   label = @Translation("Crossword Puzzle"),
 *   field_types = {
 *     "crossword"
 *   }
 * )
 */
class CrosswordPuzzleFormatter extends FileFormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    foreach ($this->getEntitiesToView($items, $langcode) as $delta => $file) {
      $url = file_url_transform_relative(file_create_url($file->getFileUri()));
      $elements[$delta] = [
        '#type' => 'markup',
        '#theme' => 'dandecrosswords_puzzle',
        '#attached' => [
          'library' => ['dandecrosswords/dandecrosswords'],
          'drupalSettings' => [
            'fileName' => [
              'url' => $url,
            ],
          ],
        ],
      ];
    }
    return $elements;
  }

}
