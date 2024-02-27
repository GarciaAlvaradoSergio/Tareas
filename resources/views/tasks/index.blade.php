<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form id="taskForm" method="POST" action="{{ route('tareas.store') }}">
            @csrf
            <input id="titleInput" name="title" type="text" placeholder="{{ __('Añade un título...') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                onfocus="showTextareaAndButton()" />
            <textarea id="contentTextarea" name="content" style="display: none;"
                placeholder="{{ __('Añade contenido a tu tarea...') }}"
                class="mt-2 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button id="submitButton" style="display: none;"
                class="mt-4">{{ __('Tarea') }}</x-primary-button>
        </form>
    </div>
    <div class="max-w-7xl mx-auto p-6 lg:p-6">
        <div class="mt-15">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach ($tasks as $task)
                    <div
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div class="flex-1">
                                <div class="flex justify-between items-center">

                                        <span class="text-gray-800">{{ $task->user->name }}</span>
                                        <small
                                            class="ml-2 text-sm text-gray-600">{{ $task->created_at->format('j M Y') }}</small>
                                        @unless ($task->created_at->eq($task->updated_at))
                                            <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                        @endunless

                                </div>
                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">{{ $task->title }}
                                </h2>
                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                    {{ $task->content }}
                                </p>
                            </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            function showTextareaAndButton() {
                document.getElementById("contentTextarea").style.display = "block";
                document.getElementById("submitButton").style.display = "block";
            }
            document.addEventListener("click", function(event) {
                var titleInput = document.getElementById("titleInput");
                var contentTextarea = document.getElementById("contentTextarea");
                var submitButton = document.getElementById("submitButton");

                // Si el clic no es en el campo de entrada del título ni en el textarea ni en el botón, ocultarlos
                if (event.target !== titleInput && event.target !== contentTextarea && event.target !== submitButton) {
                    contentTextarea.style.display = "none";
                    submitButton.style.display = "none";
                }
            });
        </script>
    @endsection

</x-app-layout>
