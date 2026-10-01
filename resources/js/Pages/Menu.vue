<script setup>
import SiteHeader from '../Components/SiteHeader.vue';
import SiteFooter from '../Components/SiteFooter.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({ products: Array, boxes: Array });
const boxImages = { 4: '/images/box-4.png', 6: '/images/box-6.png', 12: '/images/box-12.png' };
const boxDescriptions = {
  4: '4 cookies — Classic Chocolate Chip, Double Chocolate, Lotus & Red Velvet. Kinder & Pistachio are not included.',
  6: '6 cookies — one of each flavor: Classic Chocolate Chip, Double Chocolate, Pistachio, Lotus, Red Velvet & Kinder.',
  12: '12 cookies — two of each flavor: Classic Chocolate Chip, Double Chocolate, Pistachio, Lotus, Red Velvet & Kinder.'
};

const flavorImages = {
  'classic chocolate chip': '/images/classic-chocolate-chip.png',
  'double chocolate': '/images/double-chocolate.png',
  'pistachio': '/images/pistachio.png',
  'lotus': '/images/lotus.png',
  'red velvet': '/images/red-velvet.png',
  'kinder': '/images/kinder.png',
};
const getFlavorImage = (name) => flavorImages[String(name || '').trim().toLowerCase()] || '/images/cookies-hero.png';

const scoops = [
  {
    name: 'Classic Chocolate Chip Scoop',
    price: 500,
    image: '/images/scoop-classic.png',
    description: 'Soft cookie dough scoops with rich chocolate chips.'
  },
  {
    name: 'Double Chocolate Scoop',
    price: 580,
    image: '/images/scoop-double-chocolate.png',
    description: 'Rich chocolate cookie dough scoops with chocolate chips and brownie pieces.'
  },
  {
    name: 'Kinder Scoop',
    price: 640,
    image: '/images/scoop-kinder.png',
    description: 'Cookie dough scoops with Kinder chocolate and a creamy drizzle.'
  },
  {
    name: 'Mixed Scoop',
    image: '/images/scoop-mixed.png',
    mixed: true,
    description: 'Choose your mix from Classic, Double Chocolate and Kinder.'
  },
];
const mixedOptions = [
  ['Classic + Double Chocolate', 540],
  ['Classic + Kinder', 570],
  ['Double Chocolate + Kinder', 610],
  ['Classic + Double Chocolate + Kinder', 580],
];
const dips = [
  { name: 'Chocolate Sauce', price: 25, image: '/images/dip-chocolate.png' },
  { name: 'Kinder Sauce', price: 35, image: '/images/dip-kinder.png' },
  { name: 'Lotus Sauce', price: 35, image: '/images/dip-lotus.png' },
  { name: 'Pistachio Sauce', price: 40, image: '/images/dip-pistachio.png' },
];
const frozen = [
  ['Classic Chocolate Chip', 200], ['Double Chocolate', 240], ['Lotus', 280], ['Red Velvet', 280], ['Pistachio', 330], ['Kinder', 330],
];
const dipsImage = '/images/dips-extras.png';
const frozenDoughImage = '/images/frozen-dough.png';
const addItem = (name, price, kind, details = []) => router.post('/cart/item', { name, price, kind, details });
const mixedChoice = ref(mixedOptions[0]);
</script>
<template>
  <SiteHeader />
  <main class="mx-auto max-w-7xl px-5 py-14 lg:px-8">
    <section>
      <p class="eyebrow">Daily Dough</p>
      <h1 class="serif mt-3 text-6xl font-semibold tracking-[-.05em]">Meet our flavors.</h1>
      <p class="mt-5 max-w-2xl text-lg leading-8 text-brown/60">Six favorites, baked for good days.</p>
      <div class="mt-10 flex gap-4 overflow-x-auto pb-4 snap-x">
        <article v-for="p in products" :key="p.id" class="min-w-[155px] flex-1 snap-start">
          <div class="overflow-hidden rounded-[1.4rem] bg-sand"><img :src="getFlavorImage(p.name)" :alt="p.name" class="aspect-square w-full object-cover" /></div>
          <h2 class="mt-3 text-center text-sm font-semibold text-brown">{{ p.name }}</h2>
        </article>
      </div>
    </section>

    <section class="mt-24">
      <p class="eyebrow">The menu</p><h2 class="serif mt-2 text-5xl font-semibold tracking-[-.04em]">Choose your box.</h2>
      <div class="mt-10 grid gap-6 md:grid-cols-3">
        <article v-for="box in props.boxes" :key="box.name" class="overflow-hidden rounded-[1.8rem] border border-brown/10 bg-white/45 p-3">
          <div class="overflow-hidden rounded-[1.4rem] bg-sand"><img :src="boxImages[box.size]" :alt="box.name" class="aspect-[4/3] w-full object-cover" /></div>
          <div class="px-2 pb-3 pt-5"><div class="flex items-start justify-between gap-3"><h3 class="serif text-2xl font-semibold">{{ box.name }}</h3><span class="font-bold">{{ box.price }} EGP</span></div><p class="mt-3 text-sm leading-6 text-brown/60">{{ boxDescriptions[box.size] }}</p><Link href="/order/build-box" class="mt-5 inline-flex rounded-full bg-brown px-5 py-3 text-sm font-bold text-cream">Customize box</Link></div>
        </article>
      </div>
      <div class="mt-6 rounded-[1.8rem] bg-sand/55 p-7 sm:p-9"><p class="eyebrow">Mixed</p><h3 class="serif mt-2 text-3xl font-semibold">Make it yours.</h3><p class="mt-3 text-sm leading-6 text-brown/60">Choose your flavors and build your box exactly the way you like it.</p><Link href="/order/build-box" class="mt-5 inline-flex rounded-full bg-brown px-5 py-3 text-sm font-bold text-cream">Build your box</Link></div>
    </section>

    <section id="cookie-scoops" class="mt-24 scroll-mt-24"><p class="eyebrow">Cookie Scoops</p><h2 class="serif mt-2 text-5xl font-semibold tracking-[-.04em]">Big scoops. Good days.</h2>
      <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <article v-for="s in scoops" :key="s.name" class="overflow-hidden rounded-[1.8rem] border border-brown/10 bg-white/45 p-3"><div class="overflow-hidden rounded-[1.4rem] bg-sand"><img :src="s.image" :alt="s.name" class="aspect-square w-full object-cover" /></div><div class="px-2 pb-3 pt-5"><h3 class="serif text-xl font-semibold">{{ s.name }}</h3><p v-if="s.description" class="mt-2 text-sm leading-6 text-brown/60">{{ s.description }}</p><div v-if="!s.mixed" class="mt-4 flex items-center justify-between gap-3"><span class="font-bold">{{ s.price }} EGP</span><button @click="addItem(s.name,s.price,'cookie_scoop',[{name:s.name,quantity:1}])" class="rounded-full bg-brown px-4 py-2 text-sm font-bold text-cream">Add</button></div><div v-else class="mt-4"><select v-model="mixedChoice" class="field w-full"><option v-for="o in mixedOptions" :key="o[0]" :value="o">{{ o[0] }} · {{ o[1] }} EGP</option></select><button @click="addItem('Mixed Scoop · '+mixedChoice[0],mixedChoice[1],'cookie_scoop',[{name:mixedChoice[0],quantity:1}])" class="mt-3 w-full rounded-full bg-brown px-4 py-2.5 text-sm font-bold text-cream">Add</button></div></div></article>
      </div>
    </section>

    <section class="mt-24"><p class="eyebrow">Dips & Extras</p><h2 class="serif mt-2 text-5xl font-semibold tracking-[-.04em]">A little extra goes a long way.</h2><div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4"><div v-for="d in dips" :key="d.name" class="overflow-hidden rounded-[1.4rem] border border-brown/10 bg-white/45"><div class="overflow-hidden bg-sand"><img :src="d.image" :alt="d.name" class="aspect-square w-full object-cover" /></div><div class="p-5"><h3 class="font-semibold">{{ d.name }}</h3><div class="mt-3 flex items-center justify-between gap-3"><p class="font-bold">{{ d.price }} EGP</p><button @click="addItem(d.name,d.price,'dip',[{name:d.name,quantity:1}])" class="rounded-full bg-brown px-4 py-2 text-sm font-bold text-cream">Add</button></div></div></div></div></section>

    <section id="frozen-dough" class="mt-24 scroll-mt-24"><p class="eyebrow">Frozen Dough · Ready to Bake</p><h2 class="serif mt-2 text-5xl font-semibold tracking-[-.04em]">Bake your own good days.</h2><p class="mt-4 max-w-2xl text-sm leading-6 text-brown/60">One box of 6, all from the same flavor. Keep frozen, bake at 170°C for 12–14 minutes.</p><div class="mt-10 overflow-hidden rounded-[2rem] bg-sand/55"><img :src="frozenDoughImage" alt="Daily Dough frozen dough" class="w-full object-cover" /></div><div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3"><div v-for="f in frozen" :key="f[0]" class="rounded-[1.4rem] border border-brown/10 bg-white/45 p-5"><div class="flex items-center justify-between gap-3"><h3 class="font-semibold">{{ f[0] }}</h3><span class="font-bold">{{ f[1] }} EGP</span></div><div class="mt-3 flex items-center justify-between gap-3"><p class="text-xs uppercase tracking-[.14em] text-brown/50">Box of 6</p><button @click="addItem(f[0],f[1],'frozen_dough',[{name:f[0],quantity:6}])" class="rounded-full bg-brown px-4 py-2 text-sm font-bold text-cream">Add</button></div></div></div></section>
  </main><SiteFooter />
</template>
