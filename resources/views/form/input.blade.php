<SpladeInput
    {{ $attributes->only(['v-if', 'v-show', 'class'])->class(['hidden' => $isHidden()]) }}
    :flatpickr="@js($flatpickrOptions())"
    :js-flatpickr-options="{!! $jsFlatpickrOptions !!}"
    v-model="{{ $vueModel() }}"
>
    <label class="block">
        @include('splade::form.label', ['label' => $label])

        <div class="@if($label) mt-1 @endif flex rounded-md shadow-sm">
            @if($prepend)
                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500">
                    {!! $prepend !!}
                </span>
            @endif

            <input {{ $attributes->except(['v-if', 'v-show', 'class'])->class([
                'block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50',
                'rounded-md' => !$append && !$prepend,
                'rounded-none' => $append || $prepend,
                'rounded-l-md' => $append && !$prepend,
                'rounded-r-md' => !$append && $prepend,
            ])->merge([
                'name' => $name,
                'type' => $type,
                'v-model' => $flatpickrOptions() ? null : $vueModel()
            ]) }}
            />

            @if($append)
                <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500">
                    {!! $append !!}
                </span>
            @endif
        </div>
    </label>

    @includeWhen($showErrors, 'splade::form.error', ['name' => $validationKey()])
</SpladeInput>