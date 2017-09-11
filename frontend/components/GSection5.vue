<template lang="pug">
doctype html
v-container(fluid pt-0 pb-0 pr-0 pl-0 class="g-container text-xs-center")
  a(name="productos" style="display: hidden")
  v-layout(row wrap)
    v-flex(xs12 md8 offset-md2)
      p(class="black--text pt-3 mt-3 g-text-small") CONOZCA NUESTRO 
        span(class="deep-orange--text text--darken-2") TRABAJO 
      h2(class="black--text pt-0 g-section3-title") Productos y Servicios
  v-layout(row wrap class="g-layout-slider")
    v-flex( 
            v-for="(item, i) of items"
            :key="i"
            xs12 
            :style="item.style"
            class="white--text g-slide" 
            v-bind:class="{ \
              'g-zoom-in': slideIndex==i, \
              'g-zoom-out': slideIndex>i, \
              'g-slide-index-in': slideIndex==i, \
              'g-slide-index-out': slideIndex<i \
              }"
            )
      h2( class="pt-3 pb-3 white--text g-section-title"
        style="background-image: url('/bottom-red.svg')") {{ item.title }}
      v-container
        v-layout(row wrap pt-0 pb-0 pl-3 pr-3 justify-center)
          v-flex(xs12 md6 lg4)
            p {{ item.content }} 
      
      
    v-flex(xs12 md4 offset-md4 class="g-slider-control")
      v-container
        v-layout(row justify-space-around)
          v-icon(dark small class="g-control" v-on:click="anterior") chevron_left
          v-icon(dark small class="g-control" v-on:click="siguiente") chevron_right
    
</template>

<script>

export default {
  data () {
    return {
      slideIndex: 0,
      items: [
      {title: 'Oxígeno Medicinal', content: 'El Oxígeno es uno de los principales medicamentos utilizados dentro de clínicas, hospitales y asistencia domiciliaria, pues constituye un importante capítulo de la terapéutica medica. Tiene aplicaciones curativas, es indicado en casos de hipoxemia de cualquier origen para el tratamiento de enfermedades pulmonares obstructivas, neumonías, infartos del miocardio y embolias pulmonares. Su aplicación es imprescindible en los casos de resucitación cardiorrespiratoria, terapia intensiva, anestesia, tratamiento de quemaduras, terapia hiperbárica, entre otros.', style: {'background-image': "url('/producto.1.png');"}},
  
      {title: 'Oxígeno Industrial', content: 'El oxígeno es un elemento base utilizado en múltiples procesos industriales. Comúnmente, es utilizado en procesos de soldadura y oxicorte, en mezcla con gases como acetiulo o butano, para incrementar la temperatura de combustión hasta unos 6000°F, que es suficiente para fundir la mayoría de los metales. Por sus propiedades oxidantes, también es ampliamente utilizado en diversas aplicaciones en siderurgia, industria papelera, electrónica y química.', style: {'background-image': "url('/producto.2.png')"}},


      {title: 'Argón', content: 'En el ámbito industrial y científico se emplea universalmente de la recreación de atmósferas inertes (no reaccionantes) para evitar reacciones químicas indeseadas en multitud de operaciones cómo soldadura por arco y soldadura a gas, en la fabricación de titanio y otros elementos reactivos.', style: {'background-image': "url('/producto.3.png')"}},


      {title: 'Acetileno', content: 'El acetileno es conocido como gas utilizado en equipos de soldadura debido a las elevadas temperaturas (hasta 3000 °C) que alcanzan las mezclas de acetileno y oxígeno en su combustión. El acetileno es además un producto de partida importante en la industria química.', style: {'background-image': "url('/producto.4.png')"}},


      {title: 'Dióxido de Carbono', content: 'Se utiliza como agente extintor eliminando el oxígeno encontrado en ese espacio, e impidiendo que se genere una combustión. En la industria alimentaria, se utiliza en bebidas carbonatadas para darles efervescencia. También se puede utilizar como ácido inocuo o poco contaminante. La acidez puede ayudar a cuajar lácteos de una forma más rápida y por tanto barata, sin añadir ningún sabor, y en la industria se puede utilizar para neutralizar residuos alcalinos sin añadir otro ácido más contaminante como el sulfúrico.', style: {'background-image': "url('/producto.5.png')"}},


      {title: 'Helio', content: 'Industrialmente se usa en criogenia (siendo su principal uso, lo que representa alrededor de un 28 % de la producción mundial), en la refrigeración de imanes superconductores. Entre estos usos, la aplicación más importante es en los escáneres de resonancia magnética. También se utiliza como protección para la soldadura por arco y otros procesos, como el crecimiento de cristales de silicio, los cuales representan el 20 % de su uso para el primer caso y el 26 % para el segundo.', style: {'background-image': "url('/producto.6.png')"}},
    

      {title: 'Nitrogeno', content: 'La aplicación comercial más importante del nitrógeno diatómico es la obtención de amoníaco por el proceso de Haber. El amoníaco se emplea con posterioridad en la fabricación de fertilizantes y ácido nítrico. Las sales del ácido nítrico incluyen importantes compuestos como el nitrato de potasio (nitro o salitre empleado en la fabricación de pólvora) y el nitrato de amonio fertilizante. Los compuestos orgánicos de nitrógeno como la nitroglicerina y el trinitrotolueno son a menudo explosivos. La hidracina y sus derivados se usan como combustible en cohetes.', style: {'background-image': "url('/producto.7.png')"}},


      {title: 'Aire Seco', content: 'La aplicación comercial más importante del aire seco es en la acción de elevadores y destornilladores neumáticos, tornos dentales, armas de aire comprimido, equipos de mineria, arranques de motores, autos de aire comprimido y atracciones.', style: {'background-image': "url('/producto.8.png')"}},
      ]
    }
  },
  methods: {
    siguiente: function () {
      if (this.slideIndex < (this.items.length-1)) {
        this.slideIndex++
      }
    },
    anterior: function () {
      if (this.slideIndex > 0) {
        this.slideIndex--
      }
    }
  }
}
</script>

<style lang="stylus" scoped>

deepOrange = #e64a19
.g-section3-title
  font-family 'Roboto', sans
  font-weight bold
  padding-bottom 0.8em
  margin-bottom: 1em
  background url('~assets/bottom-red.svg') no-repeat bottom

.g-text-small
  font-family "Archivo Black", sans-serif 

.g-container
  background-color #ebebed
  border-top 2px solid #d2d2d5
  border-bottom 2px solid #d2d2d5

.g-section-title
  font-family 'Roboto', sans
  font-weight bold
  padding-bottom 0.8em
  margin-bottom: 1em
  background-repeat no-repeat
  background-position bottom

.g-layout-slider
  position: relative
  height: 480px

.g-slide
  position absolute
  height 100%
  width: 100%
  background-repeat no-repeat
  background-position left bottom
  background-size cover
  background-color black

.g-slide-index-in
  transform translateX(0%)
  transition transform 1s ease
  
.g-slide-index-out
  transform translateX(100%)
  transition transform 1s ease
  
.g-zoom-in
  transform scale(1)
  transform-origin 0 50%
  transition transform 1s
  
.g-zoom-out
  transform scale(0.9)
  transform-origin 0 50%
  transition transform 1s
  
.g-slider-control
  position absolute
  top 85%
  width 100%

.g-control
  cursor pointer
</style>
