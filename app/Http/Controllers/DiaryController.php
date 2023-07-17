<?php

namespace App\Http\Controllers;

use App\Http\Requests\Diary\CreateDiaryRequest;
use App\Http\Requests\Diary\UpdateDiaryRequest;
use App\Models\Diary;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class DiaryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        return view('diaries.index')->with([
            'diaries' => Auth::user()->diaries
        ]);
    }

    /**
     * @param $diaryId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit($diaryId)
    {
        $diary = Diary::findOrFail($diaryId);

        if (!Auth::user()->can('crud', $diary)) {
            abort(403);
        }

        return view('diaries.edit')->with(['diary' => $diary]);
    }

    /**
     * @param CreateDiaryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateDiaryRequest $request)
    {
        $request = $request->validated();
        $request['author_id'] = Auth::user()->id;

        Diary::create($request);

        return redirect()->to('diary.index')->with('success', __('The diary has been created'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        return view('diaries.create');
    }

    /**
     * @param UpdateDiaryRequest $request
     * @param $diaryId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateDiaryRequest $request, $diaryId)
    {
        $diary = Diary::findOrFail($diaryId);
        $request = $request->validated();

        $diary->update($request);

        return redirect()->back()->with('success', __('The diary name has been updated'));
    }

    /**
     * @param $diaryId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($diaryId)
    {
        $diary = Diary::findOrFail($diaryId);

        if (!Auth::user()->can('crud', $diary)) {
            abort(403);
        }

        $diary->delete();

        return redirect()->back()->with('success', __('The diary has been deleted'));
    }
}
