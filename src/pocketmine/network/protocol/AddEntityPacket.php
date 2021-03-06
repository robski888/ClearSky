<?php
namespace pocketmine\network\protocol;

#include <rules/DataPacket.h>

#ifndef COMPILE
use pocketmine\utils\Binary;
use pocketmine\entity\Entity;

#endif

class AddEntityPacket extends DataPacket{
	const NETWORK_ID = Info::ADD_ENTITY_PACKET;

	public $eid;
	public $type;
	public $x;
	public $y;
	public $z;
	public $speedX;
	public $speedY;
	public $speedZ;
	public $yaw;
	public $pitch;
	public $metadata = [Entity::DATA_LEAD_HOLDER => [Entity::DATA_TYPE_LONG, -1], Entity::DATA_LEAD => [Entity::DATA_TYPE_BYTE, 0]];
	public $links = [];

	public function decode(){

	}

	public function encode(){
		$this->reset();
		$this->putLong($this->eid);
		$this->putInt($this->type);
		$this->putFloat($this->x);
		$this->putFloat($this->y);
		$this->putFloat($this->z);
		$this->putFloat($this->speedX);
		$this->putFloat($this->speedY);
		$this->putFloat($this->speedZ);
		$this->putFloat($this->yaw * 0.71111);
		$this->putFloat($this->pitch * 0.71111);
		//$meta = Binary::writeMetadata($this->metadata);
		//$this->put($meta);
		$this->putShort(0);
		#if(!empty($this->metadata)){
			$meta = Binary::writeMetadata($this->metadata);
			$this->put($meta);
		#}
		$this->putShort(0);
		/*$this->putShort(count($this->links));
		foreach($this->links as $link){
			$this->putLong($link[0]);
			$this->putLong($link[1]);
			$this->putByte($link[2]);
		}*/
	}
}
