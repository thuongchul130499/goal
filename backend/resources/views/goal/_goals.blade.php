@foreach ($goals as $goal)
    <tr>
        <td>
            <a 
                href="javascript:void(0)"
                class="add-goal"
                data-id="{{ $goal->id }}" 
                data-toggle="collapse" 
                data-target="#collab-{{ $goal->id }}" 
                aria-expanded="false"
                 aria-controls="collapseExample"
            >
                <i class="mdi mdi-arrow-down-drop-circle"></i>
            </a>
            
        </td>
        <td class="pr-0 pl-4">
            <img class="profile-img img-sm" src="{{ asset('template/images/profile/male/image_4.png') }}" alt="profile image">
        </td>
        <td class="pl-md-0">
            <small class="text-black font-weight-medium d-block">{{ $goal->title }}</small>
            <span class="text-gray">
                <span class="status-indicator rounded-indicator small bg-primary"></span>
                <a href="{{ route('goals.show', $goal->id) }}">{{ __('page.goal.newTask') }}</a>
            </span>
        </td>
        <td>
            <small style="word-wrap: break-word; max-width: 150px; overflow: hidden">{{ $goal->description }}</small>
        </td>
        <td> {{ $goal->progress ?? 0 }}% </td>
        <td>{{ $goal->due_to }}</td>
        <td>{{ $goal->started_at }}</td>
    </tr>
    <tr>
        <td></td>
        <td>
            <div class="collapse" id="collab-{{ $goal->id }}">
                <div class="card card-body">
                    <ul class="pd-0">
                        @foreach ($goal->tasks as $task)
                            <li>{{ $task->title }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </td>
    </tr>
@endforeach