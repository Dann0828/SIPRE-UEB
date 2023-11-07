<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Encuesta de Satisfacción</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); border-radius: 10px;">
        <div style="text-align: left;">
            <h1 style="font-size: 24px;">{{ $details['title'] }}</h1>
            <p style="font-size: 16px;">{{ $details['body'] }}</p>
            <hr style="border: 1px solid #ddd; margin: 20px 0;">
            <div style="display: flex; align-items: center;">
            <img src="{{ $message->embed($details['img_path']) }}" alt="Firma" style="width: 120px; height: auto; margin-right: 20px; margin-top: 0;">
                <div style="margin-top: 35px;">
                    <p style="font-size: 14px; margin: 0;"><strong>Área de Soporte Técnico</strong></p>
                    <p style="font-size: 12px; margin: 5px 0;">Universidad El Bosque</p>
                    <p style="font-size: 12px; margin: 5px 0;">Contacto: soporte@unbosque.edu.co</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
