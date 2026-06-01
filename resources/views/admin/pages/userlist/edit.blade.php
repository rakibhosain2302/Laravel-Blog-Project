@if ($editUser)
    @php
        $selectedRoleId = old('role_id', $editUser->role_id);
        $selectedRoleDescription = optional($editUser->role)->description ?? '';
    @endphp

    <div class="user-edit-modal is-open" id="userEditModal" aria-hidden="false">
        <div class="user-edit-modal__backdrop" data-modal-close></div>
        <div class="user-edit-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="userEditModalTitle">
            <div class="user-edit-modal__head">
                <div>
                    <div class="user-edit-modal__eyebrow">Update user</div>
                    <h3 id="userEditModalTitle">Edit {{ $editUser->name }}</h3>
                    <p>Adjust the account details and role without leaving the user list.</p>
                </div>
                <button type="button" class="user-edit-modal__close" aria-label="Close modal" data-modal-close>
                    &times;
                </button>
            </div>

            <div class="user-edit-modal__body">
                <form action="{{ route('users.update', $editUser->id) }}" method="POST" class="user-edit-form">
                    @csrf
                    @method('PUT')

                    <div class="user-edit-form__grid">
                        <div class="user-edit-field">
                            <label for="user_edit_name">User Name</label>
                            <input
                                id="user_edit_name"
                                type="text"
                                name="name"
                                value="{{ old('name', $editUser->name) }}"
                                placeholder="Enter user name"
                            >
                            @error('name')
                                <span class="user-edit-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="user-edit-field">
                            <label for="user_edit_email">User Email</label>
                            <input
                                id="user_edit_email"
                                type="email"
                                name="email"
                                value="{{ old('email', $editUser->email) }}"
                                placeholder="Enter user email"
                            >
                            @error('email')
                                <span class="user-edit-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="user-edit-field">
                            <label for="user_edit_role_id">User Role</label>
                            <select id="user_edit_role_id" name="role_id">
                                <option value="" disabled>Select Role</option>
                                @foreach ($roles as $role)
                                    <option
                                        value="{{ $role->id }}"
                                        data-description="{{ $role->description }}"
                                        {{ (string) $selectedRoleId === (string) $role->id ? 'selected' : '' }}
                                    >
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <span class="user-edit-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="user-edit-field">
                            <label for="user_edit_role_description">Role Description</label>
                            <input
                                id="user_edit_role_description"
                                type="text"
                                value="{{ $selectedRoleDescription }}"
                                readonly
                            >
                        </div>
                    </div>

                    <div class="user-edit-actions">
                        <button type="button" class="btn-back" data-modal-close>Cancel</button>
                        <button class="btn-save" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('userEditModal');
            if (!modal) {
                return;
            }

            const roleSelect = modal.querySelector('#user_edit_role_id');
            const roleDescription = modal.querySelector('#user_edit_role_description');
            const closeTargets = modal.querySelectorAll('[data-modal-close]');

            function syncRoleDescription() {
                if (!roleSelect || !roleDescription) {
                    return;
                }

                const selectedOption = roleSelect.options[roleSelect.selectedIndex];
                roleDescription.value = selectedOption ? (selectedOption.getAttribute('data-description') || '') : '';
            }

            closeTargets.forEach(function (target) {
                target.addEventListener('click', function () {
                    modal.classList.remove('is-open');
                    modal.setAttribute('aria-hidden', 'true');

                    const url = new URL(window.location.href);
                    if (url.searchParams.has('edit_id')) {
                        url.searchParams.delete('edit_id');
                        window.history.replaceState({}, document.title, url.pathname + url.search + url.hash);
                    }
                });
            });

            if (roleSelect) {
                roleSelect.addEventListener('change', syncRoleDescription);
                syncRoleDescription();
            }
        });
    </script>
@endif
