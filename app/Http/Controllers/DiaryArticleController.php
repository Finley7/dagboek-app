<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiaryArticle\CreateDiaryArticleRequest;
use App\Http\Requests\DiaryArticle\UpdateDiaryArticleRequest;
use App\Models\Diary;
use App\Models\DiaryArticle;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class DiaryArticleController extends Controller
{
    /**
     * @param CreateDiaryArticleRequest $request
     * @param $diaryId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateDiaryArticleRequest $request, $diaryId)
    {
        $request = $request->validated();
        $request['diary_id'] = $diaryId;

        DiaryArticle::create($request);

        return redirect()->to('/diaries')->with('success', __('The diary article has been created'));
    }

    /**
     * @param $diaryId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create($diaryId)
    {
        $diary = Diary::findOrFail($diaryId);

        if (!Auth::user()->can('crud', $diary)) {
            abort(403);
        }

        return view('diary-articles.create')->with(['diary' => $diary]);
    }

    /**
     * @param UpdateDiaryArticleRequest $request
     * @param $diaryArticleId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateDiaryArticleRequest $request, $diaryArticleId)
    {
        $diary = DiaryArticle::findOrFail($diaryArticleId);
        $request = $request->validated();

        $diary->update($request);

        return redirect()->back()->with('success', __('The diary name has been updated'));
    }

    /**
     * @param $diaryArticleId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit($diaryArticleId)
    {
        $diaryArticle = DiaryArticle::findOrFail($diaryArticleId);

        if (!Auth::user()->can('crud', $diaryArticle)) {
            abort(403);
        }

        return view('diary-articles.edit')->with(['diaryArticle' => $diaryArticle]);
    }

    /**
     * @param $diaryArticleId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($diaryArticleId)
    {
        $diaryArticle = DiaryArticle::findOrFail($diaryArticleId);

        if (!Auth::user()->can('crud', $diaryArticle)) {
            abort(403);
        }

        $diaryArticle->delete();

        return redirect()->back()->with('success', __('The diary article has been deleted'));
    }
}
