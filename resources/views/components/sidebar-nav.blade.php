<button class="list-group-item list-group-item-action sidebar__button sidebar_btn_{{ $category }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $category }}" aria-expanded="false">
    <i class="{{ $icon }}"></i>
    <span>{{ $category }}</span>
    <div class="float-end sidebar__button--circle_block">
        <i class="sidebar__button--arrow fa-solid fa-angle-down"></i>
    </div>
</button>
<div class="check-collapse collapse multi-collapse {{ (request()->is(array_keys($pages))) ? 'show' : '' }}" id="{{ $category }}">
    @foreach($pages as $link => $name)
        <a href="/{{ $link }}" class=" list-group-item list-group-item-action ripple {{ (request()->is($link)) ? 'active' : '' }}">
            <span>{{ $name }}</span>
        </a>
    @endforeach
</div>

<script>
    $(document).ready(function() {
        $('.sidebar_btn_{{ $category }}').on('click', function() {
            var $collapse = $(this).closest('.check-collapse');
            $collapse.toggleClass('show');
            $(this).find('.sidebar__button--arrow').toggleClass('sidebar__button--circle');
        });

        $('.check-collapse').each(function() {
            var $collapse = $(this);
            var isOpen = $collapse.hasClass('show');
            var $button = $('button[data-bs-target="#' + $collapse.attr('id') + '"]');
            var $arrowIcon = $button.find('.sidebar__button--arrow');

            if (isOpen) {
                $arrowIcon.addClass('sidebar__button--circle');
            } else {
                $arrowIcon.removeClass('sidebar__button--circle');
            }
        });
    });

</script>
