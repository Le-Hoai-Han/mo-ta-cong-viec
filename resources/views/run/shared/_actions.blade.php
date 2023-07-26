
@can('edit_'.$entity)
    <a href="{{ route($entity.'.edit', [Str::singular($entity) => $id])  }}" class="btn btn-sm btn-light">
        ✏️</a>
@endcan

@can('delete_'.$entity)
    <form 
    method="POST" 
    action= "{{ route($entity.'.destroy', $id) }}" 
    style = 'display: inline'
    onSubmit = 'return confirm("Are yous sure wanted to delete it?")'>
    @csrf
    @method("delete")
   
    <button type="submit" class="btn-delete btn btn-sm btn-light">
            ❌
        </button>
    </form>
@endcan
