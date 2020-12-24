<p>Roadmap deel:</p>
<div class="input-group">
<input type="text" name="roadmap_task" value="{{ old('roadmap_task') ?? $roadmaptask->roadmap_task }}">
</div>
<div>{{$errors->first('roadmap_task')}}</div>