<div class="card-body">
    <div class="form-group">
        <label for="article_title">Article Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('article_title') is-invalid @enderror" id="article_title" name="article_title"
               placeholder="Enter role name" value="{{ old('article_title') ?? $article->title }}"/>
        @error('article_title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="article_category">Select article category <span class="text-danger">*</span></label>
        <select class="form-control @error('article_category') is-invalid @enderror" id="article_category" name="article_category">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $article->article_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('article_category')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="article_content">Article Content <span class="text-danger">*</span></label>
        <textarea class="summernote @error('article_content') is-invalid @enderror" id="article_content" name="article_content">{!! nl2br($article->content) !!}</textarea>
        @error('article_content')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary mr-2">{{ $button ?? 'Update' }}</button>
</div>
