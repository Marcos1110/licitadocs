<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Notifications\SignedDocumentNotification;
use App\Notifications\ReceivedDocumentNotification;
use App\Models\User;
use App\Models\Documento;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function msgDocumentoAssinado($id){
        $documento = Documento::findOrFail($id);
        $remetente = User::find($documento->remetente);

        $remetente->notify(new SignedDocumentNotification($documento,$remetente));
    }

    public function msgDocumentoRecebido($id){
        $documento = Documento::findOrFail($id);
        $remetente = User::find($documento->remetente);
        $destinatario = User::find($documento->destinatario);

        $destinatario->notify(new ReceivedDocumentNotification($documento,$destinatario, $remetente));
    }
}
