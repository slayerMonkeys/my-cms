<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    @if($type === "textarea")
        <textarea
            name="{{ $id }}"
            class="form-control"
            id="{{ $id }}"
            cols="{{ $attributes->get('cols') }}"
            rows="{{ $rows }}"
        ></textarea>
    @elseif ($attributes->get('type') === "file")
        <input type="file"
               name="{{ $id }}"
               class="form-control-file"
               id="{{ $id }}"
               @if($attributes->has('required'))
               required
               @endif
        >
    @else
        <input type="{{ $type }}"
               name="{{ $id }}"
               class="form-control"
               id="{{ $id }}"
               @if ($attributes->has("placeholder"))
                    placeholder="{{ $attributes->get("placeholder") }}"
               @endif
               @if($attributes->has('required'))
                    required
               @endif
               @if ($slot)
                   value="{{ $slot }}"
               @endif
        >
    @endif
</div>
