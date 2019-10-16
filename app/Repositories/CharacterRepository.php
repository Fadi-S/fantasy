<?php

namespace App\Repositories;


use App\Http\Requests\CharacterRequest;
use App\Models\AdminLog\AdminLog;
use App\Models\Character\Character;

class CharacterRepository
{

    public function create(CharacterRequest $request)
    {
        $character = Character::create($request->all());
        if (!is_null($character)) {
            AdminLog::createRecord("add", $character);
            flash()->success("Character Created Successfully");
        } else {
            flash()->error("Error Creating Character!")->important();
        }
    }

    public function edit(CharacterRequest $request, Character $character)
    {
        if (!AdminLog::createRecord("edit", $character, $request->keys(), $request->all())) {
            flash()->error("You didn't change anything!");

            return;
        }

        if ($character->update($request->all()))
            flash()->success("Character Updated Successfully");
        else
            flash()->error("Error Updating Character!")->important();
    }

    public function getAll($paginate = 100)
    {
        return Character::paginate($paginate);
    }

    public function delete(Character $character)
    {
        if($character->delete()) {
            flash()->warning("Character Deleted Successfully");
            AdminLog::createRecord("delete", $character);
        }else flash()->error("Error Deleting Character");
    }

}