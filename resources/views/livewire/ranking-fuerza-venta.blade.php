<div class="ranking-container">
    <h1>Ranking General - Corte Febrero</h1>
    <table>
        <tr>
            <td>#</td>
            <td>Asesor</td>
            <td>Puntos</td>
        </tr>
        {{-- @foreach ($asesores as $key => $asesor)
            <tr>
                <td>{{ $key+=1 }}</td>
                <td>{{ $asesor->nombre }}</td>
                <td>{{ $asesor->puntos }}</td>
            </tr>
        @endforeach --}}
        <tr>
            <td>1</td>
            <td>JACKSON GAITÁN</td>
            <td>810</td>
        </tr>
        <tr>
            <td>2</td>
            <td>JUAN TUIRAN</td>
            <td>740</td>
        </tr>
        <tr>
            <td>3</td>
            <td>ANGELO PATRON</td>
            <td>665</td>
        </tr>
        <tr>
            <td>4</td>
            <td>GERMAN ANDRES ISAZA ARREADONDO</td>
            <td>645</td>
        </tr>
        <tr>
            <td>5</td>
            <td>JOSE BOLIVAR</td>
            <td>560</td>
        </tr>
        <tr>
            <td>6</td>
            <td>DAVID MORAN</td>
            <td>515</td>
        </tr>
        <tr>
            <td>7</td>
            <td>MAURICIO SUAREZ</td>
            <td>490</td>
        </tr>
        <tr>
            <td>8</td>
            <td>ANDRES FELIPE LEON BELLO</td>
            <td>485</td>
        </tr>
        <tr>
            <td>9</td>
            <td>Oscar Andrés Giraldo</td>
            <td>475</td>
        </tr>
        <tr>
            <td>10</td>
            <td>ARMANDO RUIZ</td>
            <td>460</td>
        </tr>
        <tr>
            <td>{{ $user_rank += 1 }}</td>
            <td>{{ auth()->user()->nombre }}</td>
            <td>{{ auth()->user()->puntos }}</td>
        </tr>
    </table>
</div>
