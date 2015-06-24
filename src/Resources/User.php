<?php
/**
 * @file
 * Contains User.php.
 */

namespace EclipseGc\DrupalOrg\Api\Resources;


use EclipseGc\DrupalOrg\Api\FactoryInterface;

class User implements ResourceInterface {

  use GetResource;

  protected $industries;

  protected $organizations;

  protected $bio;

  protected $ircNick;

  protected $websites;

  protected $country;

  protected $gender;

  protected $languages;

  protected $terms;

  protected $expertise;

  protected $contributed;

  protected $attendance;

  protected $mentors;

  protected $drupalContributions;

  protected $firstName;

  protected $lastName;

  protected $uid;

  protected $name;

  protected $url;

  protected $editUrl;

  protected $created;

  public static function getClass(array $data) {
    return get_called_class();
  }
  
  /**
   * 
   * Arguments have been made optional using NULL to avoid warning issue with user profiles whose UID does not exist
   * 
   * @param FactoryInterface $factory
   * @param string $field_industries_worked_in
   * @param string $field_organizations
   * @param string $field_bio
   * @param string $field_irc_nick
   * @param string $field_websites
   * @param string $field_country
   * @param string $field_gender
   * @param string $field_languages
   * @param string $field_terms_of_service
   * @param string $field_areas_of_expertise
   * @param string $field_contributed
   * @param string $field_events_attended
   * @param string $field_mentors
   * @param string $field_drupal_contributions
   * @param string $field_first_name
   * @param string $field_last_name
   * @param string $uid
   * @param string $name
   * @param string $url
   * @param string $edit_url
   * @param string $created
   */
  public function __construct(FactoryInterface $factory, $field_industries_worked_in = NULL, $field_organizations = NULL, $field_bio = NULL, $field_irc_nick = NULL, $field_websites = NULL, $field_country = NULL, $field_gender = NULL, $field_languages = NULL, $field_terms_of_service = NULL, $field_areas_of_expertise = NULL, $field_contributed = NULL, $field_events_attended = NULL, $field_mentors = NULL, $field_drupal_contributions = NULL, $field_first_name = NULL, $field_last_name = NULL, $uid = NULL, $name = NULL, $url = NULL, $edit_url = NULL, $created = NULL) {
  		$this->factory = $factory;
  		$this->industries = $field_industries_worked_in;
  		$this->organizations = $field_organizations;
  		$this->bio = $field_bio;
  		$this->ircNick = $field_irc_nick;
  		$this->websites = $field_websites;
  		$this->country = $field_country;
  		$this->gender = $field_gender;
  		$this->languages = $field_languages;
  		$this->terms = $field_terms_of_service;
  		$this->expertise = $field_areas_of_expertise;
  		$this->contributed = $field_contributed;
  		$this->attendance = $field_events_attended;
  		$this->mentors = $field_mentors;
  		$this->drupalContributions = $field_drupal_contributions;
  		$this->firstName = $field_first_name;
  		$this->lastName = $field_last_name;
  		$this->uid = $uid;
  		$this->name = $name;
  		$this->url = $url;
  		$this->editUrl = $edit_url;
  		$this->created = $created;
  	//}

  }

  /**
   * @return mixed
   */
  public function getAttendance() {
    return $this->attendance;
  }

  /**
   * @return mixed
   */
  public function getBio() {
    return $this->bio;
  }

  /**
   * @return mixed
   */
  public function getContributed() {
    return $this->contributed;
  }

  /**
   * @return mixed
   */
  public function getCountry() {
    return $this->country;
  }

  /**
   * @return mixed
   */
  public function getCreated() {
    return $this->created;
  }

  /**
   * @return mixed
   */
  public function getDrupalContributions() {
    return $this->drupalContributions;
  }

  /**
   * @return mixed
   */
  public function getEditUrl() {
    return $this->editUrl;
  }

  /**
   * @return mixed
   */
  public function getExpertise() {
    return $this->expertise;
  }

  /**
   * @return mixed
   */
  public function getFirstName() {
    return $this->firstName;
  }

  /**
   * @return mixed
   */
  public function getGender() {
    return $this->gender;
  }

  /**
   * @return mixed
   */
  public function getIndustries() {
    return $this->industries;
  }

  /**
   * @return mixed
   */
  public function getIrcNick() {
    return $this->ircNick;
  }

  /**
   * @return mixed
   */
  public function getLanguages() {
    return $this->languages;
  }

  /**
   * @return mixed
   */
  public function getLastName() {
    return $this->lastName;
  }

  /**
   * @return mixed
   */
  public function getMentors() {
    $mentors = [];
    foreach ($this->mentors as $id => $mentor) {
      $mentors[$id] = $this->getResource($mentor['resource'], $mentor['id']);
    };
    return $mentors;
  }

  /**
   * @return mixed
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @return mixed
   */
  public function getOrganizations() {
    $organizations = [];
    foreach ($this->organizations as $id => $organization) {
      $organizations[$id] = $this->getResource($organization['resource'], $organization['id']);
    };
    return $organizations;
  }

  /**
   * @return mixed
   */
  public function getTerms() {
    return $this->terms;
  }

  /**
   * @return mixed
   */
  public function getUid() {
    return $this->uid;
  }

  /**
   * @return mixed
   */
  public function getUrl() {
    return $this->url;
  }

  /**
   * @return mixed
   */
  public function getWebsites() {
    return $this->websites;
  }

} 