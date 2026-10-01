<script setup>
import SiteHeader from '../Components/SiteHeader.vue';
import SiteFooter from '../Components/SiteFooter.vue';
</script>

<template>
  <SiteHeader />
  <main>
    <section class="mx-auto grid max-w-7xl items-center gap-10 px-5 py-10 md:grid-cols-[.9fr_1.1fr] md:py-16 lg:px-8 lg:py-20">
      <div class="max-w-xl">
        <p class="eyebrow">Cookies · Dough · Good Days</p>
        <h1 class="serif mt-5 text-[4.2rem] font-semibold leading-[.9] tracking-[-.055em] sm:text-7xl lg:text-[6.4rem]">
          Sweet things<br><span class="italic font-normal text-caramel">bring people</span><br>together.
        </h1>
        <p class="mt-7 max-w-lg text-base leading-7 text-brown/65 sm:text-lg">
          Thick, indulgent cookies made for slow mornings, sweet moments, and the people you want to share them with.
        </p>
        <div class="mt-8 flex flex-wrap gap-3">
          <Link href="/order/build-box" class="rounded-full bg-brown px-7 py-3.5 text-sm font-bold text-cream shadow-sm transition hover:-translate-y-0.5 hover:shadow-xl">Build Your Box</Link>
          <Link href="/menu" class="rounded-full border border-brown/15 bg-white/35 px-7 py-3.5 text-sm font-bold transition hover:bg-white/70">Explore Flavors</Link>
        </div>
        <div class="mt-10 flex items-center gap-5 text-xs font-semibold uppercase tracking-[.18em] text-brown/45">
          <span>Freshly baked</span><span class="h-1 w-1 rounded-full bg-caramel"></span><span>Made to share</span>
        </div>
      </div>

      <div class="relative overflow-hidden rounded-[2.5rem] bg-sand p-3 shadow-[0_30px_80px_rgba(59,36,24,.12)]">
        <div class="overflow-hidden rounded-[2rem]">
          <img :src="'/images/cookies-hero.png'" alt="Daily Dough cookies" class="aspect-square w-full object-cover transition duration-700 hover:scale-[1.02]" />
        </div>
        <div class="absolute bottom-7 left-7 rounded-2xl border border-white/40 bg-cream/90 px-4 py-3 shadow-lg backdrop-blur">
          <p class="text-[10px] font-bold uppercase tracking-[.22em] text-caramel">The Daily Dough way</p>
          <p class="serif mt-1 text-lg font-semibold">Big cookies. Good days.</p>
        </div>
      </div>
    </section>

    <!-- Quick discovery: Cookie Scoops + Frozen Dough -->
    <section class="mx-auto max-w-7xl px-5 py-16 lg:px-8">
      <div class="max-w-2xl">
        <p class="eyebrow">More good things</p>
        <h2 class="serif mt-2 text-4xl font-semibold tracking-[-.03em] sm:text-5xl">Something for every craving.</h2>
        <p class="mt-4 text-base leading-7 text-brown/60">Go straight to our Cookie Scoops or keep a box of ready-to-bake dough at home.</p>
      </div>

      <div class="mt-9 grid gap-6 md:grid-cols-2">
        <Link href="/menu#cookie-scoops" class="group overflow-hidden rounded-[2rem] border border-brown/10 bg-white/45 p-3 transition duration-300 hover:-translate-y-1 hover:bg-white/70 hover:shadow-xl">
          <div class="overflow-hidden rounded-[1.6rem] bg-sand">
            <img :src="'/images/scoop-classic.png'" alt="Classic Chocolate Chip Cookie Scoop" class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-105" />
          </div>
          <div class="flex items-end justify-between gap-5 px-3 pb-3 pt-5">
            <div>
              <p class="eyebrow">Cookie Scoops</p>
              <h3 class="serif mt-1 text-3xl font-semibold">Big scoops. Good days.</h3>
              <p class="mt-2 text-sm leading-6 text-brown/60">Classic, Double Chocolate, Kinder or a mix of your favorites.</p>
            </div>
            <span class="shrink-0 rounded-full bg-brown px-4 py-2.5 text-sm font-bold text-cream">Explore</span>
          </div>
        </Link>

        <Link href="/menu#frozen-dough" class="group overflow-hidden rounded-[2rem] border border-brown/10 bg-white/45 p-3 transition duration-300 hover:-translate-y-1 hover:bg-white/70 hover:shadow-xl">
          <div class="overflow-hidden rounded-[1.6rem] bg-sand">
            <img :src="'/images/frozen-dough.png'" alt="Daily Dough frozen dough ready to bake" class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-105" />
          </div>
          <div class="flex items-end justify-between gap-5 px-3 pb-3 pt-5">
            <div>
              <p class="eyebrow">Frozen Dough · Ready to Bake</p>
              <h3 class="serif mt-1 text-3xl font-semibold">Bake your own good days.</h3>
              <p class="mt-2 text-sm leading-6 text-brown/60">Keep frozen and bake your favorite cookies whenever the craving hits.</p>
            </div>
            <span class="shrink-0 rounded-full bg-brown px-4 py-2.5 text-sm font-bold text-cream">Explore</span>
          </div>
        </Link>
      </div>
    </section>

    <section class="mx-auto max-w-7xl px-5 pb-10 lg:px-8">
      <div class="overflow-hidden rounded-[2.25rem] bg-brown text-cream">
        <div class="grid items-center md:grid-cols-[1.05fr_.95fr]">
          <div class="p-8 sm:p-12 lg:p-16">
            <p class="text-xs font-bold uppercase tracking-[.25em] text-[#e7c39c]">Build your box</p>
            <h2 class="serif mt-3 text-4xl font-semibold tracking-[-.03em] sm:text-5xl">Your box.<br><span class="italic font-normal text-[#e7c39c]">Your rules.</span></h2>
            <p class="mt-5 max-w-md leading-7 text-cream/65">Pick 4, 6, or 12 cookies and fill your box with the flavors you actually want.</p>
            <Link href="/order/build-box" class="mt-7 inline-flex rounded-full bg-cream px-7 py-3.5 text-sm font-bold text-brown transition hover:-translate-y-0.5">Start building</Link>
          </div>
          <div class="h-full min-h-[300px] bg-[#5a3927] p-6 sm:p-8"><img :src="'/images/home-box-6.png'" alt="Daily Dough Box of 6" class="h-full w-full rounded-[1.75rem] object-cover opacity-90" /></div>
        </div>
      </div>
    </section>
  </main>
  <SiteFooter />
</template>
