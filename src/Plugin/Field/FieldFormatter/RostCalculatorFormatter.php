<?php

namespace Drupal\rost_calculator\Plugin\Field\FieldFormatter;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Field\Annotation\FieldFormatter;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\rost_calculator\Calculator\Calculator;

/**
 * Class RostCalculatorFormatter
 * @package Drupal\RostCalculator\Plugin\Field\FieldFormatter
 * @FieldFormatter(
 *     id = "Rost_Calculator",
 *     label = @Translation("Rost Calculator"),
 *     field_types={
 *          "text",
 *          "text_long",
 *          "summary",
 *          "string"
 *      }
 * )
 */
class RostCalculatorFormatter extends FormatterBase
{
    public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings)
    {
        parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);
    }


    /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode)
    {
        $calculator = new Calculator();
        $element = [];

        foreach ($items as $delta => $item) {
            $calculatedValue = $calculator->execute($item->value);
            $element[$delta] = [
                '#calculated_value' => $calculatedValue,
                '#markup' => $item->value,
                '#theme' => 'rost_calculator_formatter'
            ];
        }

        return $element;
    }
}