<div class="ranking-container">
    <h1>Ranking General</h1>
    <table>
        <tr>
            <td>#</td>
            <td>Asesor</td>
            <td>Puntos</td>
        </tr>
        @foreach ($asesores as $key => $asesor)
            <tr>
                <td>{{ $key+=1 }}</td>
                <td>{{ $asesor->nombre }}</td>
                <td>{{ $asesor->puntos }}</td>
            </tr>
        @endforeach
        <tr>
            <td>{{ $user_rank+=1 }}</td>
            <td>{{ auth()->user()->nombre }}</td>
            <td>{{ auth()->user()->puntos }}</td>
        </tr>
    </table>
</div>
