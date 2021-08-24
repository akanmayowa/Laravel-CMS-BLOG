
            @if ($errors->any())
            <div class="bg-red-500 text-4xl text-white rounded-md border-red-200">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif