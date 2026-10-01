<template>
  <header class="sticky top-0 z-50 border-b border-brown/10 bg-cream/90 backdrop-blur-xl">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8">
      <Link href="/" class="group flex items-center gap-2">
        <span class="serif text-[1.65rem] font-semibold tracking-[-.04em]">Daily Dough</span>
        <span class="text-caramel transition-transform group-hover:rotate-12">♡</span>
      </Link>
      <nav class="hidden items-center gap-8 text-[13px] font-semibold md:flex">
        <Link href="/menu" class="nav-link">Menu</Link>
        <Link href="/order/build-box" class="nav-link">Build Your Box</Link>
        <Link href="/cart" class="nav-link">Cart</Link>
      </nav>
      <Link href="/order/build-box" class="rounded-full bg-brown px-5 py-2.5 text-[13px] font-bold text-cream shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
        Order Now
      </Link>
    </div>
  </header>
</template>
