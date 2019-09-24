// Aula 01

//Após iniciar um projeto sem activity, criaremos uma manualmente:
package br.com.alura.agenda;

import android.app.Activity;

public class MainActivity extends Activity {

}

// Após isso, criaremos dentro do AndroidManifest.xml
<activity android:name=".MainActivity">
  <intent-filter>
    <action android:name="android.intent.action.MAIN"/>
    <category android:name="android.intent.category.LAUNCHER"/>
  </intent-filter>
</activity>

//Pronto, agora ela é o "método main"

//No Android, não existe um método main, a execução é baseada no ciclo de vida
//Cada etapa do ciclo do app tem seu método respectivo que será executado ao ocorrer o evento.

...
import android.os.Bundle;
import android.support.annotation.Nullable;

public class MainActivity extends Activity {
  @Override
  protected void onCreate(@Nullable Bundle savedInstanceState) {
    //Se tiver a dependencia do AndroidX será @androidx.annotation.Nullable no lugar de @Nullable
    super.onCreate(savedInstanceState);//Obrigatório
    Toast.makeText(context:this, text:"Juan Ananda", Toast.LENGTH_LONG).show(); //Exibe um pequeno texto temporário
  }
}
