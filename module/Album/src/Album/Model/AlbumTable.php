<?php

namespace Album\Model;

use Zend\Db\TableGateway\TableGateway;


class AlbumTable
{
	
	protected $tableGateway;
	
	
	/**
	 * 
	 * @param TableGateway $tableGateway
	 */
	public function __construct( TableGateway  $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	
	public function fetAll()
	{
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}
	
	
	public function getAlbum( $id )
	{
		$id = (int) $id;
		$rowset = $this->tableGateway->select( array( 'id' => $id ) );
		$row = $rowset->current();
		
		if( !$row ){
			throw new \Exception('Could not find $id');
		}
		
		return $row;
	}
	
	/**
	 * INSERT AND UPDATE in one functionality
	 * @param Album $album
	 */
	public function saveAlbum( Album $album )
	{
		$data = array(
				'artist' => $album->artist,
				'title' => $album->title,	
		);
		
		
		$id = (int) $album->id;
		
		if( $row == 0 ){
			//insert if data is not existing
			$this->tableGateway->insert($data);
		} else {
			//update database if data exist
			if( $this->getAlbum( $id ) ){
				$this->tableGateway->update( $data, array( 'id' => $id ) );
			}else{
				//you know what this is don't ask
				throw new \Exception('Album id does not exist');
			}
			
		}
		
	}
	
	
	
	public function deleteAlbum( $id )
	{
		$this->tableGateway->delete( array( 'id' => (int) $id ) );
		//add some functionality here like throw error, return true if success
		//whatever dude....
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}