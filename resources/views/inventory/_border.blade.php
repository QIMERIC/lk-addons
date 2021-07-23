<li class="list-group-item">
    <a class="card-title h5 collapse-title"  data-toggle="collapse" href="#openBorderForm"> Unlock Border</a>
    <div id="openBorderForm" class="collapse">
        {!! Form::hidden('tag', $tag->tag) !!}
        <p>This action is not reversible. Are you sure you want to unlock this border?</p>
        <div class="text-right">
            {!! Form::button('Unlock', ['class' => 'btn btn-primary', 'name' => 'action', 'value' => 'act', 'type' => 'submit']) !!}
        </div>
    </div>
</li>
