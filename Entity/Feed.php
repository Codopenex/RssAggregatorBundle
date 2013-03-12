<?php
// src/Codopenex/RssAggregatorBundle/Entity/Feed.php

namespace Codopenex\RssAggregatorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Codopenex\RssAggregatorBundle\Repository\FeedRepository")
 * @ORM\Table(name="feed")
 */
class Feed
{
    /**
     * @ORM\ManyToMany(targetEntity="Codopenex\UserBundle\Entity\User", mappedBy="Feed")
     **/
    private $users;
	
    public function __construct() {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }
	
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $url;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;
	
	/**
     * @ORM\Column(type="string")
     */
    protected $link;
	
    /**
     * @ORM\Column(type="text")
     */
    protected $description;
	
    /**
     * @ORM\Column(type="string", length=5)
     */
    protected $language;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $lastBuildDate;
	
    /**
     * @ORM\Column(type="integer")
     */
    protected $ttl;
	
    /**
     * @ORM\Column(type="string")
     */
    protected $image_title;
	
    /**
     * @ORM\Column(type="string")
     */
    protected $image_url;
	
	/**
     * @ORM\Column(type="string")
     */
    protected $image_link;
	
    /**
     * @ORM\Column(type="text")
     */
    protected $image_description;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Feed
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Feed
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Feed
     */
    public function setLink($link)
    {
        $this->link = $link;
    
        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Feed
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return Feed
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set lastBuildDate
     *
     * @param \DateTime $lastBuildDate
     * @return Feed
     */
    public function setLastBuildDate($lastBuildDate)
    {
        $this->lastBuildDate = $lastBuildDate;
    
        return $this;
    }

    /**
     * Get lastBuildDate
     *
     * @return \DateTime 
     */
    public function getLastBuildDate()
    {
        return $this->lastBuildDate;
    }

    /**
     * Set ttl
     *
     * @param integer $ttl
     * @return Feed
     */
    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
    
        return $this;
    }

    /**
     * Get ttl
     *
     * @return integer 
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * Set image_title
     *
     * @param string $imageTitle
     * @return Feed
     */
    public function setImageTitle($imageTitle)
    {
        $this->image_title = $imageTitle;
    
        return $this;
    }

    /**
     * Get image_title
     *
     * @return string 
     */
    public function getImageTitle()
    {
        return $this->image_title;
    }

    /**
     * Set image_url
     *
     * @param string $imageUrl
     * @return Feed
     */
    public function setImageUrl($imageUrl)
    {
        $this->image_url = $imageUrl;
    
        return $this;
    }

    /**
     * Get image_url
     *
     * @return string 
     */
    public function getImageUrl()
    {
        return $this->image_url;
    }

    /**
     * Set image_link
     *
     * @param string $imageLink
     * @return Feed
     */
    public function setImageLink($imageLink)
    {
        $this->image_link = $imageLink;
    
        return $this;
    }

    /**
     * Get image_link
     *
     * @return string 
     */
    public function getImageLink()
    {
        return $this->image_link;
    }

    /**
     * Set image_description
     *
     * @param string $imageDescription
     * @return Feed
     */
    public function setImageDescription($imageDescription)
    {
        $this->image_description = $imageDescription;
    
        return $this;
    }

    /**
     * Get image_description
     *
     * @return string 
     */
    public function getImageDescription()
    {
        return $this->image_description;
    }

    /**
     * Add users
     *
     * @param \Codopenex\RssAggregatorBundle\Entity\User $users
     * @return Feed
     */
    public function addUser(\Codopenex\RssAggregatorBundle\Entity\User $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param \Codopenex\RssAggregatorBundle\Entity\User $users
     */
    public function removeUser(\Codopenex\RssAggregatorBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}