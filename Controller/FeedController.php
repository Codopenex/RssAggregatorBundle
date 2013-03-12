<?php

namespace Codopenex\RssAggregatorBundle\Controller;

use Iga\RssBundle\Controller\RssController as BaseRssController;
use Codopenex\RssAggregatorBundle\Entity\Feed;

/**
 * RSS Feed controller.
 */
class FeedController extends BaseRssController
{
    /**
     * Show a RSS Feed's elements that we like to persist
     */
    public function analyzeAction($url)
    {
        $rss = $this->getAction($url);
		$channel = $rss->getChannel(true);
		$rssdoc = $rss->getRSS();
	//var_dump($rssdoc);
	//die();
		$RssChannelTitle = (isset($rssdoc['rss']['channel']['title']) ? $rssdoc['rss']['channel']['title'] : 'Title not present');
		$RssChannelLink = (isset($rssdoc['rss']['channel']['link']) ? $rssdoc['rss']['channel']['link'] : 'Link not present');
		$RssChannelDescription = (isset($rssdoc['rss']['channel']['description']) ? $rssdoc['rss']['channel']['description'] : 'Description not present');
		$RssChannelLanguage = (isset($rssdoc['rss']['channel']['language']) ? $rssdoc['rss']['channel']['language'] : 'Language not present');
		$RssChannelLastBuildDate = (isset($rssdoc['rss']['channel']['lastBuildDate']) ? $rssdoc['rss']['channel']['lastBuildDate'] : 'lastBuildDate not present');
		$RssChannelTtl = (isset($rssdoc['rss']['channel']['ttl']) ? $rssdoc['rss']['channel']['ttl'] : 'Ttl not present');
		$RssChannelImageTitle = (isset($rssdoc['rss']['channel']['image']['title']) ? $rssdoc['rss']['channel']['image']['title'] : 'Image Title not present');
		$RssChannelImageUrl = (isset($rssdoc['rss']['channel']['image']['url']) ? $rssdoc['rss']['channel']['image']['url'] : 'Image Url not present');
		$RssChannelImageLink = (isset($rssdoc['rss']['channel']['image']['link']) ? $rssdoc['rss']['channel']['image']['link'] : 'Image Link not present');
		$RssChannelImageDescription = (isset($rssdoc['rss']['channel']['image']['description']) ? $rssdoc['rss']['channel']['image']['description'] : 'Image Description not present');
		
		$feed = new Feed();
		$feed->setUrl($url)
			->setTitle($RssChannelTitle)
			->setLink($RssChannelLink) 
			->setDescription($RssChannelDescription)
			->setLanguage($RssChannelLanguage)
			->setLastBuildDate($RssChannelLastBuildDate)
			->setTtl($RssChannelTtl)
			->setImageTitle($RssChannelImageTitle)
			->setImageUrl($RssChannelImageUrl)
			->setImageLink($RssChannelImageLink)
			->setImageDescription($RssChannelImageDescription);
			
		//Be nice to understand error messaging stuff see below
		if(!$this->feedExists($feed->getUrl()))
		{
			$em = $this->getDoctrine()
					->getEntityManager();
					
			$em->persist($feed);
			$em->flush();
		}else{
			//throw $this->createNotFoundException('The feed already exists');
		}

		foreach($channel as $k => $v){
			$nodes[] = $k;	
		}
		
        return $this->render('CodopenexRssAggregatorBundle:Feed:analyze.html.twig', array(
            'nodes'      => $nodes,
			'rssdoc'	 => $rssdoc,
			'feed'		 => $feed
        ));
    }
	
    /**
     * Show a RSS Feed
     */
    public function showAction($url)
    {
        $rss = $this->getAction($url);
		$items = $rss->getItems();

        return $this->render('CodopenexRssAggregatorBundle:Feed:show.html.twig', array(
            'items'      => $items
        ));
    }
	
    /**
     * Show All RSS Feeds
     */
    public function showfeedsAction()
    {	
		$feeds = $this->getFeedsRepo();

        return $this->render('CodopenexRssAggregatorBundle:Feed:showfeeds.html.twig', array(
            'feeds'      => $feeds
        ));
    }
	
	/**
     * Get Feeds from repository
     */
	private function getFeedsRepo()
	{
		$em = $this->getDoctrine()->getEntityManager();
		
		$feeds = $em->getRepository('CodopenexRssAggregatorBundle:Feed')->getFeeds();
		
		//Needs rethink as throws not found if there are no feeds
        //if (!$feeds) {
            //throw $this->createNotFoundException('Unable to find Feeds.');
        //}
		
		return $feeds;		
	}
	
	/**
     * Check Feed exists in database
     */
	private function feedExists($url)
	{
		$feeds = $this->getFeedsRepo();
		
		foreach($feeds as $k => $v)
		{	
			if($url == $v->getUrl())
			{
				return true;	
			}
		}
		
		return false;
	}
}