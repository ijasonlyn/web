<?php
    abstract class Unit 
    {
        
        public function getComposit() 
        {
            return null;
        }

        abstract public function bombardStrength() : int;
    }

    abstract class CompositeUnit extends Unit
    {
        private $units = [];

        public function getComposit() 
        {
            return $this;
        }

        public function addUnit(Unit $unit) 
        {
            if( in_array( $unit, $this->units,true)) 
            {
                return;
            }
            $this->units[] = $unit;
        }

        public function removeUnit(Unit $unit)
        {
            $idx = array_search($unit, $this->units, true);
            if (is_int($idx))
            {
                array_splice($this->units, $idx, 1, []);
            }
        }

        public function getUnits(): array
        {
            return $this->units;
        }
    }

    class Army extends CompositeUnit
    {
        public function bombardStrength() :int 
        {
            $ret = 0;
            foreach($this->units as $unit) 
            {
                $ret += $unit->bombardStrength();
            }

            return $ret;
        }
    }

    class TroopCarrier extends CompositeUnit
    {
        public function addUnit(Unit $unit) 
        {
            if ($unit instanceof Cavalry)
            {
                throu new UnitException("Can't get a hourse on the vehicle");
            }
            parent::addUnit($unit);
        }

        public function bombardStrength():int {
            return 0;
        }
    }

    class UnitException extends \Exception
    {
    }
    
    class Archer extends Unit
    {
        public function bombardStrength()
        {
            return 4;
        }
    }

    class LaserCanon extends Unit 
    {
        public function bombardStrength()
        {
            return 33;
        }
    }

    class Calvary extends Unit 
    {
        public function bombardStrength()
        {
            return 5
        }
    }

?>