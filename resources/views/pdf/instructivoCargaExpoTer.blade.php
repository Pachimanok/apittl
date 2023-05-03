<table width="100%" border="0" cellpadding="1" cellspacing="0" bordercolor="#999999" class="tablaContenido">
    <tr>
        <td width="50%" valign="top" class="tdContenido" style="border:none; text-align:left;">
            <img src="https://botzero.tech/ttl/images/ttl/TTchica.png" style="width:10rem;height 8rem;" alt="">
        </td>
        <td width="50%" valign="top" class="tdContenido" style="border:none; text-align:right;">
            <img src="{{ $img }}" style="width:10rem; height 8rem;" alt="">
        </td>
    </tr>
</table>
<h3 style="text-align:left; margin-bottom: 0; font-family: sans-serif; text-transform: uppercase;" >Orden de Trabajo N° {{ $id_asign }}</h3>
<h5 style="text-align:left;margin: 0; font-family: sans-serif;text-transform: uppercase;">EXPO TERRESTRE</h5>
<table width="100%" style="border: none;font-family: sans-serif; text-transform: uppercase;" cellspacing="0" bordercolor="#999999" class="tablaContenido">
    <tr>
        <td align="left" class="tdContenidoItem" ><strong>Facturar: {{ $title }} - CUIT: {{$cuit}}</strong></td>
    </tr>   
</table>
<table style="font-family: sans-serif;text-transform: uppercase; font-size: small;" width="100%" border="0"  cellspacing="0" bordercolor="#999999" class="tablaContenido">
    <tr>
        <td colspan="5" align="center" width="25%" bgcolor="#a9c8e4" style="border: none;" class="tdContenido">DATOS DE REFERENCIA</td>
    </tr>
    <tr>
        <td align="left" colspan="1" ><strong>Operación N°: </strong></td>
        <td colspan="4" class="tdContenido">{{ $ref_customer }}</td>
    </tr> 
    <tr>
        <td align="left" colspan="1" ><strong>Referencia: </strong></td>
        <td colspan="4" class="tdContenido">{{ $booking}}</td>
    </tr>
    <tr>
        <td align="left" width="25%" class="tdContenidoItem"><strong>Cant y Tipo CNTR: </strong></td>
        <td colspan="4" width="25%" class="tdContenido">1 X {{$cntr_type}}</td>
    </tr>
    <tr>
        <td align="left" width="25%" class="tdContenidoItem"><strong>Peso por CNTR: </strong></td>
        <td colspan="4" width="25%" class="tdContenido">{{$net_weight}}</td>
    </tr>
    <tr>
        <td align="left" width="25%" class="tdContenidoItem"><strong>Mercaderia:</strong></td>
        <td colspan="4"  class="tdContenido">{{ $commodity }}</td>
    </tr>
    <tr>
        <td colspan="5" align="center" width="25%" bgcolor="#a9c8e4" style="border: none;" class="tdContenido">DESCRIPCIÓN DE LA OPERACION:</td>
    </tr>
    <tr>
        <td align="left" width="25%" class="tdContenidoItem"><strong>FECHA DE CARGA:</strong></td>
        <td colspan="4"  class="tdContenido">{{ $load_date }}</td>
    </tr>
    <tr>
        <td align="left" width="25%" class="tdContenidoItem"><strong>Exportador:</strong></td>
        <td colspan="4"  class="tdContenido">{{ $shipper }}</td>
    </tr>
    <tr>
        <td align="left" width="25%" class="tdContenidoItem"><strong>Lugar de Carga:</strong></td>
        <td colspan="4"  class="tdContenido"><a href="{{ $link_maps }}">
            {{$load_place}} [ {{ $address }} - {{ $city }} ]</small></a></td>
    </tr>
    <tr>
        <td align="left" width="25%" class="tdContenidoItem"><strong>Aduana Expo:</strong></td>
        <td colspan="4"  class="tdContenido">{{ $custom_place }}</td>
    </tr>
    <tr>
        <td align="left" width="25%" class="tdContenidoItem"><strong>Despachante Expo:</strong></td>
        <td colspan="4"  class="tdContenido">{{ $custom_agent }} [ {{ $custom_agent_mail }} - {{ $custom_agent_phone }}]</td>
    </tr>
    <tr>
        <td align="left" width="25%" class="tdContenidoItem"><strong>Aduana Impo:</strong></td>
        <td colspan="4"  class="tdContenido">{{ $custom_place_impo }}</td>
    </tr>
    <tr>
        <td align="left" width="25%" class="tdContenidoItem"><strong>Despachante Impo:</strong></td>
        <td colspan="4"  class="tdContenido">{{ $custom_agent_impo }} [ {{ $custom_agent_mail_impo }} - {{ $custom_agent_phone_impo }}]</td>
    </tr>
    <tr>
        <td align="left" width="25%" class="tdContenidoItem"><strong>Importador:</strong></td>
        <td colspan="4"  class="tdContenido">{{ $importador }}</td>
    </tr>
    <tr>
        <td align="left" width="25%" class="tdContenidoItem"><strong>Lugar de Desarga:</strong></td>
        <td colspan="4"  class="tdContenido"><a href="{{ $descarga_link }}">
            {{$descarga_place}} [ {{ $descarga_address }} - {{ $descarga_city }} ]</small></a></td>
    </tr>
    <tr>
        <td colspan="5" align="center" width="25%" bgcolor="#a9c8e4" style="border: none;" class="tdContenido">PROVEEDOR TERRESTRE:</td>
    </tr>
    <tr>
        <td align="left" width="25%" class="tdContenidoItem"><strong>TRANSPORTE:</strong></td>
        <td colspan="4"  class="tdContenido">{{ $transport }} [ {{ $transport_agent }} ]</td>
    </tr>
    <tr>
        <td align="left" width="25%" class="tdContenidoItem"><strong>VALOR POR CNTR:</strong></td>
        <td colspan="4"  class="tdContenido">{{ $out_usd }} - {{ $modo_pago_out }} {{ $plazo_de_pago_out}} </td>
    </tr>
    <tr>
        <td align="left" width="25%" class="tdContenidoItem"><strong>OBSERVACIONES:</strong></td>
        <td colspan="4"  class="tdContenido">{{ $observation_customer }} <br> {{ $observation_load}}</td>
    </tr>
</table>
<hr>
<p style="text-align:left;  color:red; font-family: sans-serif;text-transform: uppercase;">
    ENVIAR FACTURA DENTRO DE LOS 7 DÍAS DE HABER FINALIZADO EL SERVICIO. 
    <br>LA FACTURA NO SE CANCELARÁ SI NO SE ADJUNTA ESTA INSTRUCIÓN + MIC/DTA Y CRT + INTERCHANGE. 
</p>
<hr>
<p style="text-align:left; margin-button:0; font-family: sans-serif;text-transform: uppercase;">
Oblicación contar con SATELITAL de unidad y con elementos de seguridad:
<br> CASCO - ZAPATOS DE SEGURIDAD Y CHALECO REFLACTARIO.
</p>
<h6    style="text-align: center; font-family: sans-serif;"> <small> Tecnología programada por </small><a href="https://rail.ar" target="_blank">RailCode</a><small> para <a href="https://botzero.tech" target="_blank">BOTZero :: Software de Logística.</a></small> </h6>

