<?php

namespace Drupal\candidate_webform\Plugin\WebformHandler;

use Drupal\webform\Plugin\WebformHandler\EmailWebformHandler;
use Drupal\webform\WebformSubmissionInterface;
use Drupal\node\Entity\Node;

/**
 * Emails a webform submission.
 *
 * @WebformHandler(
 * id = "candidate_email",
 * label = @Translation("Caandidate email"),
 * category = @Translation("Notification"),
 * description = @Translation("Sends a webform to candidate email."),
 * cardinality = \Drupal\webform\Plugin\WebformHandlerInterface::CARDINALITY_UNLIMITED,
 * results = \Drupal\webform\Plugin\WebformHandlerInterface::RESULTS_PROCESSED,
 * )
 */
class MyEmailWebformHandler extends EmailWebformHandler {

  /**
   * Send message to the candidate email.
   */
  public function sendMessage(WebformSubmissionInterface $webform_submission, array $message) {

    $candidate_id = \Drupal::request()->query->get('candidate');
    $candidate = Node::load($candidate_id);
    $email = $candidate->get('field_candidate_email')->getValue();

    $message['to_mail'] = $email[0]['value'];

    parent::sendMessage($webform_submission, $message);
  }

}
