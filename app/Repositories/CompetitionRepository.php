<?php

namespace App\Repositories;


use App\Http\Requests\CompetitionRequest;
use App\Models\AdminLog\AdminLog;
use App\Models\Competition\Competition;

class CompetitionRepository
{

    public function create(CompetitionRequest $request)
    {
        $competition = Competition::create($request->all());
        if (!is_null($competition)) {
            AdminLog::createRecord("add", $competition);
            flash()->success("Competition Created Successfully");
        } else {
            flash()->error("Error Creating Competition!")->important();
        }
    }

    public function edit(CompetitionRequest $request, Competition $competition)
    {
        if (!AdminLog::createRecord("edit", $competition, $request->keys(), $request->all())) {
            flash()->error("You didn't change anything!");

            return;
        }

        if ($competition->update($request->except("type_id")))
            flash()->success("Competition Updated Successfully");
        else
            flash()->error("Error Updating Competition!")->important();
    }

    public function getAll($paginate = 100)
    {
        return Competition::paginate($paginate);
    }

    public function delete(Competition $competition)
    {
        if($competition->delete()) {
            flash()->warning("Competition Deleted Successfully");
            AdminLog::createRecord("delete", $competition);
        }else flash()->error("Error Deleting Competition");
    }

}