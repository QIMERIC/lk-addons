<?php namespace App\Services\Item;

use App\Services\Service;

use DB;

use App\Services\InventoryManager;

use App\Models\Item\Item;
use App\Models\User\User;
use App\Models\User\UserItem;
use App\Models\User\UserBorder;
use App\Models\Character\Character;

class BorderService extends Service
{
    /*
    |--------------------------------------------------------------------------
    | Box Service
    |--------------------------------------------------------------------------
    |
    | Handles the editing and usage of box type items.
    |
    */

    /**
     * Retrieves any data that should be used in the item tag editing form.
     *
     * @return array
     */
    public function getEditData()
    {
        return[

        ];
    }

    /**
     * Processes the data attribute of the tag and returns it in the preferred format.
     *
     * @param  string  $tag
     * @return mixed
     */
    public function getTagData($tag)
    {
        $borderData['user_id'] = isset($tag->data['user_id']) ? $tag->data['user_id'] : null;
        $borderData['border_id'] = isset($tag->data['border_id']) ? $tag->data['border_id'] : null;

        return $borderData;
    }

    /**
     * Processes the data attribute of the tag and returns it in the preferred format.
     *
     * @param  string  $tag
     * @param  array   $data
     * @return bool
     */
    public function updateData($tag, $data)
    {
       //put inputs into an array to transfer to the DB
       $borderData['user_id'] = isset($data['user_id']) ? $data['user_id'] : null;
       $borderData['border_id'] = isset($data['border_id']) ? $data['border_id'] : null;

       DB::beginTransaction();

       try {
           //get characterData array and put it into the 'data' column of the DB for this tag
           $tag->update(['data' => json_encode($borderData)]);

           return $this->commitReturn(true);
       } catch(\Exception $e) {
           $this->setError('error', $e->getMessage());
       }
       return $this->rollbackReturn(false);
    }


    /**
     * Acts upon the item when used from the inventory.
     *
     * @param  \App\Models\User\UserItem  $stacks
     * @param  \App\Models\User\User      $user
     * @param  array                      $data
     * @return bool
     */
    public function act($stacks, $user, $data)
    {
        //:kaboom: the item in the inventory and pass on which border has been unlocked to the user_borders table
        DB::beginTransaction();

    try{
        foreach($stacks as $key=>$stack){
            if($stack->user_id != $user->id) throw new \Exception("This border does not belong to you.");
            if(Border::where('border_id', $stack->id)->exists()) throw new \Exception("You have already unlocked this border.");

            if((new InventoryManager)->debitStack($stack->user, 'Border Unlocked', ['data' => ''], $stack, $data['quantities'][$key])) {
                $borderData = new Border;
                $borderData->user_id = $user->id;
                $borderData->border_id = $stack->id;
                $borderData->save();
            }
        }
        return $this->commitReturn(true);
    } catch(\Exception $e) {
        $this->setError('error', $e->getMessage());
    }
    return $this->rollbackReturn(false);
    }

    /**
     * ueuughrh
     */
    private function populateBorderData($data, $border = null)
    {
        $borders = Border::with('border_id')->get();
    }
}
