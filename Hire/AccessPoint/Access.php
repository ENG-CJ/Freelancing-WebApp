


<?php 

class  AccessAuth
{
    
    /**
     * Checking if the required type is on the hook
     */
    public static function Auth(string $currentType,string $requiredType):bool{
           if($currentType!=$requiredType)
            return false;

            return true;
    }
}




?>