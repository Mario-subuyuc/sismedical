<h3>
    <p style="text-align: center;">Horarios de atención<br>{{$consultorios->nombre}}</p>
</h3>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table style="text-align: center; font-size: 14px;" class="table table-striped table-hover table-sm table-bordered">
                    <hr>
                    <thead>
                        <tr style="text-align: center">
                            <th>Hora</th>
                            <th>Lunes</th>
                            <th>Martes</th>
                            <th>Miércoles</th>
                            <th>Jueves</th>
                            <th>Viernes</th>
                            <th>Sábado</th>
                            <th>Domingo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $horas = [
                        '08:00:00 - 09:00:00',
                        '09:00:00 - 10:00:00',
                        '10:00:00 - 11:00:00',
                        '11:00:00 - 12:00:00',
                        '12:00:00 - 13:00:00',
                        '13:00:00 - 14:00:00',
                        '14:00:00 - 15:00:00',
                        '15:00:00 - 16:00:00',
                        '16:00:00 - 17:00:00',
                        '17:00:00 - 18:00:00',
                        '18:00:00 - 19:00:00',
                        '19:00:00 - 20:00:00'
                        ];
                        $diasSemana = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO', 'DOMINGO'];
                        @endphp

                        @foreach($horas as $hora)
                        @php
                        list($hora_inicio, $hora_fin) = explode(' - ', $hora);
                        @endphp
                        <tr>
                            <td>{{ $hora }}</td>
                            @foreach($diasSemana as $dia)
                            @php
                            $nombre_doctor = '||'; // Valor por defecto

                            // Aquí recorremos todos los horarios para encontrar si existe un doctor en ese día y hora
                            foreach ($horarios as $horarioItem) {
                            if (strtoupper($horarioItem->dia) == $dia &&
                            $hora_inicio >= $horarioItem->hora_inicio &&
                            $hora_fin <= $horarioItem->hora_fin) {
                                $nombre_doctor = $horarioItem->doctor->nombres . ' ' . $horarioItem->doctor->apellidos . '-' .$horarioItem->doctor->especialidad;
                                break; // Terminamos el loop si encontramos el horario para esa hora y día
                                }
                                }
                                @endphp
                                <td>{{ $nombre_doctor }}</td>
                                @endforeach
                        </tr>
                        @endforeach
                        
                    </tbody>
                    
                </table>
                
            </div>
        </div>
    </div>
</div>