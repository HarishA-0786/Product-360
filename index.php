<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LuxeProduct | Premium 360° Showcase</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
*{margin:0;padding:0;box-sizing:border-box;}

:root{
  --bg-primary:#07090F;
  --bg-secondary:#0C0F1A;
  --bg-card:#111420;
  --glass-bg:rgba(17,20,32,0.75);
  --glass-border:rgba(255,255,255,0.07);
  --accent:#8B5CF6;
  --accent-glow:#7C3AED;
  --accent-soft:#A78BFA;
  --accent-2:#C084FC;
  --accent-gradient:linear-gradient(135deg,#8B5CF6,#C084FC);
  --gold:#F59E0B;
  --text-white:#FFFFFF;
  --text-gray:#94A3B8;
  --text-muted:#64748B;
  --radius-xl:32px;
  --radius-lg:24px;
  --radius-md:16px;
  --radius-sm:10px;
}

body{
  background:var(--bg-primary);
  font-family:'DM Sans',sans-serif;
  color:var(--text-white);
  overflow-x:hidden;
  line-height:1.6;
  cursor:none;
}

/* ── Custom Cursor ── */
.cursor{position:fixed;width:12px;height:12px;background:var(--accent);border-radius:50%;pointer-events:none;z-index:99999;transition:transform 0.1s,background 0.2s;mix-blend-mode:screen;}
.cursor-ring{position:fixed;width:36px;height:36px;border:1.5px solid rgba(139,92,246,0.5);border-radius:50%;pointer-events:none;z-index:99998;transition:transform 0.15s cubic-bezier(.25,.46,.45,.94);}

/* ── Scrollbar ── */
::-webkit-scrollbar{width:5px;}
::-webkit-scrollbar-track{background:var(--bg-secondary);}
::-webkit-scrollbar-thumb{background:var(--accent);border-radius:10px;}

/* ── Noise texture overlay ── */
body::before{
  content:'';position:fixed;inset:0;
  background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
  pointer-events:none;z-index:0;opacity:0.4;
}

/* ══════════════════ HEADER ══════════════════ */
header{
  position:fixed;top:0;left:0;right:0;z-index:1000;
  background:rgba(7,9,15,0.8);
  backdrop-filter:blur(24px) saturate(180%);
  -webkit-backdrop-filter:blur(24px) saturate(180%);
  border-bottom:1px solid rgba(139,92,246,0.12);
  padding:0 5%;height:72px;
  display:flex;align-items:center;justify-content:space-between;
}

.logo{
  font-family:'Syne',sans-serif;font-weight:800;font-size:1.5rem;
  background:var(--accent-gradient);-webkit-background-clip:text;background-clip:text;color:transparent;
  text-decoration:none;letter-spacing:-0.02em;
}
.logo sup{font-size:0.55rem;background:var(--accent-gradient);-webkit-background-clip:text;background-clip:text;color:transparent;vertical-align:super;}

nav{display:flex;gap:2rem;align-items:center;}
nav a{color:var(--text-gray);text-decoration:none;font-size:0.85rem;font-weight:500;transition:color 0.2s;position:relative;}
nav a::after{content:'';position:absolute;bottom:-4px;left:0;width:0;height:1.5px;background:var(--accent-gradient);transition:width 0.25s;border-radius:2px;}
nav a:hover{color:#fff;}
nav a:hover::after,nav a.active::after{width:100%;}
nav a.active{color:#fff;}

.header-cta{
  background:var(--accent-gradient);border:none;padding:0.5rem 1.4rem;
  border-radius:40px;color:#fff;font-size:0.82rem;font-weight:600;
  cursor:pointer;transition:all 0.3s;font-family:'DM Sans',sans-serif;
  box-shadow:0 0 20px rgba(139,92,246,0.3);
}
.header-cta:hover{transform:translateY(-2px);box-shadow:0 8px 30px rgba(139,92,246,0.5);}

.hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;padding:4px;}
.hamburger span{width:22px;height:2px;background:#fff;border-radius:2px;transition:all 0.3s;}

/* ══════════════════ HERO ══════════════════ */
.hero{
  min-height:100vh;display:flex;align-items:center;
  padding:100px 5% 60px;position:relative;overflow:hidden;
}

.hero-bg-glow{
  position:absolute;top:-20%;left:50%;transform:translateX(-50%);
  width:900px;height:900px;border-radius:50%;
  background:radial-gradient(circle,rgba(139,92,246,0.08) 0%,transparent 65%);
  pointer-events:none;
}
.hero-bg-glow-2{
  position:absolute;bottom:-30%;right:-10%;
  width:600px;height:600px;border-radius:50%;
  background:radial-gradient(circle,rgba(192,132,252,0.05) 0%,transparent 65%);
  pointer-events:none;
}

.hero-inner{
  display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;
  max-width:1300px;margin:0 auto;width:100%;position:relative;z-index:1;
}

.hero-badge{
  display:inline-flex;align-items:center;gap:8px;
  background:rgba(139,92,246,0.1);border:1px solid rgba(139,92,246,0.25);
  padding:6px 16px;border-radius:40px;font-size:0.75rem;font-weight:600;
  color:var(--accent-soft);letter-spacing:0.08em;text-transform:uppercase;
  margin-bottom:1.5rem;animation:fadeInUp 0.6s ease both;
}
.hero-badge i{font-size:0.65rem;}

.hero-title{
  font-family:'Syne',sans-serif;font-size:clamp(2.8rem,5.5vw,4.5rem);
  font-weight:800;line-height:1.05;letter-spacing:-0.03em;
  animation:fadeInUp 0.6s 0.1s ease both;
}
.hero-title .gradient-text{
  background:var(--accent-gradient);-webkit-background-clip:text;background-clip:text;color:transparent;
}
.hero-title .gold-text{color:var(--gold);}

.hero-desc{
  color:var(--text-gray);font-size:1rem;line-height:1.7;
  margin:1.5rem 0 2.5rem;max-width:460px;
  animation:fadeInUp 0.6s 0.2s ease both;
}

.hero-actions{display:flex;gap:1rem;align-items:center;animation:fadeInUp 0.6s 0.3s ease both;}
.btn-primary{
  background:var(--accent-gradient);border:none;
  padding:0.85rem 2rem;border-radius:50px;
  color:#fff;font-size:0.9rem;font-weight:600;
  cursor:pointer;transition:all 0.3s;font-family:'DM Sans',sans-serif;
  box-shadow:0 0 30px rgba(139,92,246,0.35);
  display:flex;align-items:center;gap:8px;
}
.btn-primary:hover{transform:translateY(-3px);box-shadow:0 12px 40px rgba(139,92,246,0.5);}
.btn-ghost{
  background:transparent;border:1px solid rgba(255,255,255,0.12);
  padding:0.85rem 2rem;border-radius:50px;
  color:var(--text-gray);font-size:0.9rem;font-weight:500;
  cursor:pointer;transition:all 0.3s;font-family:'DM Sans',sans-serif;
  display:flex;align-items:center;gap:8px;
}
.btn-ghost:hover{border-color:var(--accent);color:#fff;background:rgba(139,92,246,0.08);}

.hero-stats{
  display:flex;gap:2.5rem;margin-top:3rem;
  animation:fadeInUp 0.6s 0.4s ease both;
}
.stat-item{display:flex;flex-direction:column;}
.stat-num{
  font-family:'Syne',sans-serif;font-size:1.8rem;font-weight:800;
  background:var(--accent-gradient);-webkit-background-clip:text;background-clip:text;color:transparent;
}
.stat-label{color:var(--text-muted);font-size:0.75rem;font-weight:500;margin-top:2px;}

/* ══════════════════ 360° VIEWER ══════════════════ */
.viewer-wrap{
  position:relative;animation:fadeInRight 0.8s 0.2s ease both;
}

.viewer-card{
  background:var(--bg-card);border:1px solid var(--glass-border);
  border-radius:var(--radius-xl);overflow:hidden;
  box-shadow:0 40px 100px rgba(0,0,0,0.6),0 0 0 1px rgba(139,92,246,0.08);
  position:relative;
}

.viewer-header{
  display:flex;align-items:center;justify-content:space-between;
  padding:1rem 1.4rem;border-bottom:1px solid var(--glass-border);
  background:rgba(255,255,255,0.02);
}
.viewer-dots{display:flex;gap:6px;}
.viewer-dots span{width:10px;height:10px;border-radius:50%;display:block;}
.viewer-dots span:nth-child(1){background:#FF5F57;}
.viewer-dots span:nth-child(2){background:#FFBD2E;}
.viewer-dots span:nth-child(3){background:#28CA41;}
.viewer-label{
  font-size:0.72rem;font-weight:600;color:var(--text-muted);letter-spacing:0.1em;text-transform:uppercase;
  display:flex;align-items:center;gap:6px;
}
.viewer-label i{color:var(--accent-soft);}

/* 360 Canvas area */
.viewer-canvas{
  width:100%;aspect-ratio:1/1;max-height:400px;
  position:relative;overflow:hidden;background:radial-gradient(ellipse at 50% 60%,rgba(139,92,246,0.06) 0%,var(--bg-card) 70%);
  display:flex;align-items:center;justify-content:center;
}

/* Product SVG rendered as frames */
.product-stage{
  width:80%;height:80%;position:relative;
  display:flex;align-items:center;justify-content:center;
}

/* Animated product — SVG watch/product */
.product-svg-wrap{
  width:100%;height:100%;display:flex;align-items:center;justify-content:center;
  transition:transform 0.05s linear;
  user-select:none;
}

/* Shadow under product */
.product-shadow{
  position:absolute;bottom:6%;left:50%;transform:translateX(-50%);
  width:55%;height:18px;
  background:radial-gradient(ellipse,rgba(139,92,246,0.35) 0%,transparent 70%);
  border-radius:50%;filter:blur(8px);
  transition:width 0.1s;
}

/* Drag hint ring */
.drag-hint{
  position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
  width:120px;height:120px;border-radius:50%;
  border:1.5px dashed rgba(139,92,246,0.2);
  animation:rotate360 12s linear infinite;pointer-events:none;opacity:0;
  transition:opacity 0.5s;
}
.drag-hint.show{opacity:1;}
.drag-hint::after{
  content:'↔';position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
  color:rgba(139,92,246,0.5);font-size:1.4rem;
}

.grab-label{
  position:absolute;bottom:14px;left:50%;transform:translateX(-50%);
  background:rgba(139,92,246,0.15);border:1px solid rgba(139,92,246,0.2);
  padding:5px 14px;border-radius:30px;font-size:0.7rem;color:var(--accent-soft);
  display:flex;align-items:center;gap:6px;pointer-events:none;
  transition:opacity 0.3s;
}
.grab-label.hide{opacity:0;}

/* Viewer controls */
.viewer-controls{
  display:flex;align-items:center;justify-content:space-between;
  padding:0.9rem 1.4rem;border-top:1px solid var(--glass-border);
  background:rgba(255,255,255,0.02);
}
.ctrl-group{display:flex;gap:8px;}
.ctrl-btn{
  width:34px;height:34px;border-radius:50%;
  background:rgba(255,255,255,0.05);border:1px solid var(--glass-border);
  color:var(--text-gray);font-size:0.7rem;cursor:pointer;
  transition:all 0.2s;display:flex;align-items:center;justify-content:center;
}
.ctrl-btn:hover{background:rgba(139,92,246,0.2);border-color:var(--accent);color:#fff;}
.ctrl-btn.active{background:rgba(139,92,246,0.25);border-color:var(--accent);color:var(--accent-soft);}

.zoom-display{
  font-family:'Syne',sans-serif;font-size:0.8rem;font-weight:700;
  color:var(--accent-soft);padding:0 8px;
}

/* Floating badge on viewer */
.viewer-float-badge{
  position:absolute;top:16px;right:16px;
  background:rgba(7,9,15,0.85);border:1px solid rgba(139,92,246,0.3);
  backdrop-filter:blur(10px);border-radius:12px;
  padding:8px 12px;display:flex;flex-direction:column;align-items:flex-end;
  font-size:0.7rem;z-index:10;
}
.badge-360{
  font-family:'Syne',sans-serif;font-size:1.2rem;font-weight:800;
  background:var(--accent-gradient);-webkit-background-clip:text;background-clip:text;color:transparent;line-height:1;
}
.badge-sub{color:var(--text-muted);margin-top:2px;}

/* Color dots selector */
.color-selector{
  position:absolute;bottom:16px;right:16px;z-index:10;
  display:flex;flex-direction:column;gap:7px;
}
.color-dot{
  width:20px;height:20px;border-radius:50%;cursor:pointer;
  border:2px solid transparent;transition:all 0.2s;
}
.color-dot.active,.color-dot:hover{border-color:#fff;transform:scale(1.2);}
.color-dot[data-color="purple"]{background:linear-gradient(135deg,#8B5CF6,#C084FC);}
.color-dot[data-color="gold"]{background:linear-gradient(135deg,#F59E0B,#FDE68A);}
.color-dot[data-color="cyan"]{background:linear-gradient(135deg,#06B6D4,#67E8F9);}
.color-dot[data-color="rose"]{background:linear-gradient(135deg,#F43F5E,#FB7185);}

/* ══════════════════ PRODUCT SECTIONS ══════════════════ */
section{max-width:1300px;margin:0 auto;padding:5rem 5%;}

.section-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;
  color:var(--accent-soft);margin-bottom:1rem;
}
.section-eyebrow::before{content:'';width:24px;height:1px;background:var(--accent-soft);}
.section-title{
  font-family:'Syne',sans-serif;font-size:clamp(2rem,3.5vw,3rem);font-weight:800;
  line-height:1.1;letter-spacing:-0.02em;margin-bottom:1rem;
}
.section-title span{background:var(--accent-gradient);-webkit-background-clip:text;background-clip:text;color:transparent;}
.section-desc{color:var(--text-gray);font-size:0.95rem;max-width:520px;line-height:1.7;}

/* ── Features ── */
.features-grid{
  display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-top:3rem;
}
.feature-card{
  background:var(--bg-card);border:1px solid var(--glass-border);
  border-radius:var(--radius-lg);padding:2rem;
  transition:all 0.3s;position:relative;overflow:hidden;
  cursor:default;
}
.feature-card::before{
  content:'';position:absolute;inset:0;border-radius:inherit;
  background:var(--accent-gradient);opacity:0;transition:opacity 0.3s;
}
.feature-card:hover{border-color:rgba(139,92,246,0.3);transform:translateY(-6px);box-shadow:0 20px 60px rgba(139,92,246,0.15);}
.feature-card:hover::before{opacity:0.04;}
.feature-icon{
  width:48px;height:48px;border-radius:14px;
  background:rgba(139,92,246,0.12);display:flex;align-items:center;justify-content:center;
  font-size:1.2rem;color:var(--accent-soft);margin-bottom:1.2rem;
  transition:all 0.3s;
}
.feature-card:hover .feature-icon{background:rgba(139,92,246,0.25);color:#fff;}
.feature-card h3{font-family:'Syne',sans-serif;font-weight:700;font-size:1rem;margin-bottom:0.5rem;}
.feature-card p{color:var(--text-gray);font-size:0.85rem;line-height:1.6;}

/* ── Products Grid ── */
.products-section{padding:5rem 5%;}
.products-wrap{max-width:1300px;margin:0 auto;}

.filter-bar{
  display:flex;gap:8px;margin-top:2.5rem;flex-wrap:wrap;
}
.filter-pill{
  background:rgba(255,255,255,0.04);border:1px solid var(--glass-border);
  padding:6px 18px;border-radius:40px;font-size:0.8rem;font-weight:500;
  color:var(--text-gray);cursor:pointer;transition:all 0.2s;
}
.filter-pill:hover,.filter-pill.active{
  background:rgba(139,92,246,0.15);border-color:var(--accent);color:#fff;
}

.products-grid{
  display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-top:2rem;
}

.product-card{
  background:var(--bg-card);border:1px solid var(--glass-border);
  border-radius:var(--radius-lg);overflow:hidden;
  transition:all 0.35s cubic-bezier(.25,.46,.45,.94);
  cursor:pointer;position:relative;
}
.product-card:hover{
  border-color:rgba(139,92,246,0.3);transform:translateY(-8px);
  box-shadow:0 30px 80px rgba(139,92,246,0.18);
}

.product-thumb{
  aspect-ratio:4/3;position:relative;overflow:hidden;
  background:radial-gradient(ellipse at 50% 60%,rgba(139,92,246,0.08),var(--bg-card));
  display:flex;align-items:center;justify-content:center;
}

.product-thumb svg{width:60%;height:60%;transition:transform 0.5s cubic-bezier(.25,.46,.45,.94);}
.product-card:hover .product-thumb svg{transform:scale(1.08) rotate(-3deg);}

.thumb-tag{
  position:absolute;top:12px;left:12px;
  background:rgba(139,92,246,0.2);border:1px solid rgba(139,92,246,0.3);
  padding:4px 10px;border-radius:20px;font-size:0.67rem;font-weight:600;
  color:var(--accent-soft);text-transform:uppercase;letter-spacing:0.06em;
}
.thumb-360{
  position:absolute;bottom:12px;right:12px;
  background:rgba(0,0,0,0.6);border:1px solid rgba(255,255,255,0.1);
  padding:5px 10px;border-radius:20px;font-size:0.67rem;font-weight:700;
  color:#fff;display:flex;align-items:center;gap:5px;backdrop-filter:blur(8px);
  opacity:0;transition:opacity 0.25s;
}
.product-card:hover .thumb-360{opacity:1;}

.product-info{padding:1.3rem;}
.product-brand{font-size:0.7rem;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:4px;}
.product-name{font-family:'Syne',sans-serif;font-weight:700;font-size:1rem;margin-bottom:0.4rem;}
.product-desc{color:var(--text-gray);font-size:0.8rem;line-height:1.5;margin-bottom:1rem;}
.product-footer{display:flex;align-items:center;justify-content:space-between;}
.product-price{
  font-family:'Syne',sans-serif;font-weight:800;font-size:1.1rem;
  background:var(--accent-gradient);-webkit-background-clip:text;background-clip:text;color:transparent;
}
.btn-view{
  background:rgba(139,92,246,0.12);border:1px solid rgba(139,92,246,0.25);
  padding:6px 14px;border-radius:30px;font-size:0.75rem;font-weight:600;
  color:var(--accent-soft);cursor:pointer;transition:all 0.2s;
}
.btn-view:hover{background:rgba(139,92,246,0.25);border-color:var(--accent);color:#fff;}

/* ── Testimonials ── */
.testimonials-section{padding:5rem 5%;background:var(--bg-secondary);}
.testimonials-wrap{max-width:1300px;margin:0 auto;}
.testimonials-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-top:2.5rem;}
.testimonial-card{
  background:var(--bg-card);border:1px solid var(--glass-border);
  border-radius:var(--radius-lg);padding:1.8rem;
}
.stars{color:var(--gold);font-size:0.8rem;margin-bottom:1rem;}
.testimonial-text{color:var(--text-gray);font-size:0.88rem;line-height:1.7;margin-bottom:1.5rem;font-style:italic;}
.testimonial-author{display:flex;align-items:center;gap:12px;}
.author-avatar{
  width:38px;height:38px;border-radius:50%;
  background:var(--accent-gradient);display:flex;align-items:center;justify-content:center;
  font-family:'Syne',sans-serif;font-weight:800;font-size:0.85rem;flex-shrink:0;
}
.author-name{font-weight:600;font-size:0.85rem;}
.author-role{color:var(--text-muted);font-size:0.73rem;}

/* ── CTA ── */
.cta-section{
  padding:5rem 5%;text-align:center;
  background:linear-gradient(135deg,rgba(139,92,246,0.06) 0%,rgba(192,132,252,0.04) 100%);
  border-top:1px solid rgba(139,92,246,0.08);
  border-bottom:1px solid rgba(139,92,246,0.08);
}
.cta-inner{max-width:700px;margin:0 auto;}
.cta-inner h2{font-family:'Syne',sans-serif;font-size:clamp(1.8rem,3.5vw,3rem);font-weight:800;margin-bottom:1rem;}
.cta-inner p{color:var(--text-gray);margin-bottom:2rem;}
.cta-btns{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;}

/* ── Footer ── */
footer{
  background:var(--bg-secondary);border-top:1px solid var(--glass-border);
  padding:3rem 5%;display:flex;align-items:center;justify-content:space-between;
  flex-wrap:wrap;gap:1.5rem;
}
.footer-logo{
  font-family:'Syne',sans-serif;font-weight:800;font-size:1.2rem;
  background:var(--accent-gradient);-webkit-background-clip:text;background-clip:text;color:transparent;
}
.footer-links{display:flex;gap:1.5rem;flex-wrap:wrap;}
.footer-links a{color:var(--text-muted);text-decoration:none;font-size:0.8rem;transition:color 0.2s;}
.footer-links a:hover{color:#fff;}
.footer-copy{color:var(--text-muted);font-size:0.75rem;}

/* ══════════════════ MODAL (360 full viewer) ══════════════════ */
.modal-overlay{
  display:none;position:fixed;inset:0;z-index:9000;
  background:rgba(7,9,15,0.95);backdrop-filter:blur(20px);
  align-items:center;justify-content:center;
}
.modal-overlay.show{display:flex;}
.modal-box{
  width:90%;max-width:900px;background:var(--bg-card);
  border:1px solid rgba(139,92,246,0.2);border-radius:var(--radius-xl);
  overflow:hidden;box-shadow:0 60px 120px rgba(0,0,0,0.7),0 0 0 1px rgba(139,92,246,0.1);
  display:flex;flex-direction:column;
  animation:zoomIn 0.35s cubic-bezier(.25,.46,.45,.94);
}
.modal-top{
  display:flex;align-items:center;justify-content:space-between;
  padding:1rem 1.5rem;border-bottom:1px solid var(--glass-border);
  background:rgba(255,255,255,0.02);
}
.modal-title{font-family:'Syne',sans-serif;font-weight:700;font-size:1rem;}
.modal-close{
  width:32px;height:32px;border-radius:50%;
  background:rgba(255,255,255,0.06);border:1px solid var(--glass-border);
  color:var(--text-gray);cursor:pointer;transition:all 0.2s;
  display:flex;align-items:center;justify-content:center;font-size:0.8rem;
}
.modal-close:hover{background:rgba(244,63,94,0.2);border-color:#F43F5E;color:#F43F5E;}

.modal-body{
  display:grid;grid-template-columns:1fr 320px;
  min-height:500px;
}
.modal-viewer{
  background:radial-gradient(ellipse at 50% 60%,rgba(139,92,246,0.07),var(--bg-primary));
  display:flex;align-items:center;justify-content:center;
  position:relative;overflow:hidden;padding:2rem;
}
.modal-viewer-inner{
  width:100%;aspect-ratio:1/1;max-height:380px;
  display:flex;align-items:center;justify-content:center;
  position:relative;
}
.modal-product-svg{
  width:75%;height:75%;transition:transform 0.04s linear;
  user-select:none;display:flex;align-items:center;justify-content:center;
}
.modal-grab-hint{
  position:absolute;bottom:16px;left:50%;transform:translateX(-50%);
  font-size:0.72rem;color:var(--text-muted);display:flex;align-items:center;gap:6px;
}
.modal-spin-btn{
  position:absolute;bottom:16px;right:16px;
  background:rgba(139,92,246,0.15);border:1px solid rgba(139,92,246,0.3);
  padding:6px 14px;border-radius:30px;font-size:0.72rem;font-weight:600;
  color:var(--accent-soft);cursor:pointer;transition:all 0.2s;
  display:flex;align-items:center;gap:6px;
}
.modal-spin-btn:hover,.modal-spin-btn.spinning{background:rgba(139,92,246,0.3);border-color:var(--accent);color:#fff;}

.modal-sidebar{
  border-left:1px solid var(--glass-border);padding:1.8rem;
  display:flex;flex-direction:column;gap:1rem;overflow-y:auto;
}
.ms-brand{font-size:0.7rem;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.08em;}
.ms-name{font-family:'Syne',sans-serif;font-weight:800;font-size:1.3rem;line-height:1.2;margin-bottom:0.2rem;}
.ms-desc{color:var(--text-gray);font-size:0.82rem;line-height:1.6;}
.ms-price{
  font-family:'Syne',sans-serif;font-weight:800;font-size:1.8rem;
  background:var(--accent-gradient);-webkit-background-clip:text;background-clip:text;color:transparent;
  margin:0.5rem 0;
}
.ms-divider{height:1px;background:var(--glass-border);margin:0.3rem 0;}
.ms-label{font-size:0.72rem;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.6rem;}
.ms-colors{display:flex;gap:8px;flex-wrap:wrap;}
.ms-color-dot{
  width:24px;height:24px;border-radius:50%;cursor:pointer;
  border:2px solid transparent;transition:all 0.2s;
}
.ms-color-dot:hover,.ms-color-dot.active{border-color:#fff;transform:scale(1.15);}
.ms-color-dot.purple{background:linear-gradient(135deg,#8B5CF6,#C084FC);}
.ms-color-dot.gold{background:linear-gradient(135deg,#F59E0B,#FDE68A);}
.ms-color-dot.cyan{background:linear-gradient(135deg,#06B6D4,#67E8F9);}
.ms-color-dot.rose{background:linear-gradient(135deg,#F43F5E,#FB7185);}
.ms-color-dot.black{background:linear-gradient(135deg,#1E293B,#334155);}

.ms-specs{display:flex;flex-direction:column;gap:6px;}
.spec-row{display:flex;justify-content:space-between;font-size:0.78rem;padding:5px 0;border-bottom:1px solid rgba(255,255,255,0.04);}
.spec-key{color:var(--text-muted);}
.spec-val{color:var(--text-gray);font-weight:500;}

.ms-actions{display:flex;flex-direction:column;gap:8px;margin-top:auto;}
.btn-buy{
  background:var(--accent-gradient);border:none;padding:0.7rem 1.5rem;
  border-radius:40px;color:#fff;font-weight:600;font-size:0.85rem;
  cursor:pointer;transition:all 0.3s;font-family:'DM Sans',sans-serif;
  box-shadow:0 0 20px rgba(139,92,246,0.3);
}
.btn-buy:hover{box-shadow:0 8px 30px rgba(139,92,246,0.5);transform:translateY(-2px);}
.btn-wishlist{
  background:transparent;border:1px solid var(--glass-border);
  padding:0.7rem 1.5rem;border-radius:40px;
  color:var(--text-gray);font-size:0.85rem;font-weight:500;
  cursor:pointer;transition:all 0.2s;font-family:'DM Sans',sans-serif;
  display:flex;align-items:center;justify-content:center;gap:8px;
}
.btn-wishlist:hover{border-color:rgba(244,63,94,0.4);color:#F43F5E;}

/* ── Rotation indicator ── */
.rotation-ring{
  position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
  width:90%;aspect-ratio:1/1;border:1px dashed rgba(139,92,246,0.08);
  border-radius:50%;pointer-events:none;
}
.rotation-dot{
  position:absolute;top:0;left:50%;transform:translateX(-50%) translateY(-5px);
  width:8px;height:8px;border-radius:50%;
  background:var(--accent);box-shadow:0 0 10px var(--accent);
}

/* ══════════════════ ANIMATIONS ══════════════════ */
@keyframes fadeInUp{from{opacity:0;transform:translateY(24px);}to{opacity:1;transform:translateY(0);}}
@keyframes fadeInRight{from{opacity:0;transform:translateX(24px);}to{opacity:1;transform:translateX(0);}}
@keyframes rotate360{from{transform:rotate(0deg);}to{transform:rotate(360deg);}}
@keyframes zoomIn{from{opacity:0;transform:scale(0.92);}to{opacity:1;transform:scale(1);}}
@keyframes spinPulse{0%,100%{box-shadow:0 0 0 0 rgba(139,92,246,0.4);}50%{box-shadow:0 0 20px 6px rgba(139,92,246,0.2);}}
@keyframes float{0%,100%{transform:translateY(0);}50%{transform:translateY(-10px);}}

/* ══════════════════ RESPONSIVE ══════════════════ */
@media(max-width:1024px){
  .hero-inner{grid-template-columns:1fr;gap:3rem;}
  .viewer-wrap{max-width:480px;margin:0 auto;width:100%;}
  .features-grid,.products-grid,.testimonials-grid{grid-template-columns:1fr 1fr;}
  .modal-body{grid-template-columns:1fr;}
  .modal-sidebar{border-left:none;border-top:1px solid var(--glass-border);}
  nav{display:none;}
  .hamburger{display:flex;}
}
@media(max-width:640px){
  .features-grid,.products-grid,.testimonials-grid{grid-template-columns:1fr;}
  .hero-stats{gap:1.5rem;}
  .hero-actions{flex-direction:column;align-items:flex-start;}
}

/* Mobile nav */
.mobile-nav{
  display:none;position:fixed;inset:0;z-index:9001;
  background:rgba(7,9,15,0.97);backdrop-filter:blur(20px);
  flex-direction:column;align-items:center;justify-content:center;gap:2rem;
}
.mobile-nav.show{display:flex;}
.mobile-nav a{font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:700;color:var(--text-gray);text-decoration:none;transition:color 0.2s;}
.mobile-nav a:hover{color:#fff;}
.mobile-nav-close{position:absolute;top:20px;right:5%;font-size:1.5rem;cursor:pointer;color:var(--text-gray);}

/* ── Toast ── */
.toast{
  position:fixed;bottom:24px;left:50%;transform:translateX(-50%) translateY(60px);
  background:var(--bg-card);border:1px solid rgba(139,92,246,0.3);
  border-radius:40px;padding:10px 22px;font-size:0.82rem;color:#fff;
  z-index:99999;transition:transform 0.35s cubic-bezier(.25,.46,.45,.94);
  display:flex;align-items:center;gap:8px;pointer-events:none;
  box-shadow:0 8px 30px rgba(0,0,0,0.5);
}
.toast.show{transform:translateX(-50%) translateY(0);}
.toast i{color:var(--accent-soft);}
</style>
</head>
<body>

<!-- Custom Cursor -->
<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<!-- Mobile Nav -->
<nav class="mobile-nav" id="mobileNav">
  <span class="mobile-nav-close" id="mobileClose"><i class="fas fa-times"></i></span>
  <a href="#" onclick="scrollToSection('features');closeMobileNav()">Features</a>
  <a href="#" onclick="scrollToSection('products');closeMobileNav()">Products</a>
  <a href="#" onclick="scrollToSection('reviews');closeMobileNav()">Reviews</a>
  <a href="#" onclick="scrollToSection('contact');closeMobileNav()">Contact</a>
</nav>

<!-- Header -->
<header>
  <a class="logo" href="#">LUXE<sup>®</sup></a>
  <nav>
    <a href="#" onclick="scrollToSection('features')">Features</a>
    <a href="#" onclick="scrollToSection('products')" class="active">Products</a>
    <a href="#" onclick="scrollToSection('reviews')">Reviews</a>
    <a href="#" onclick="scrollToSection('contact')">Contact</a>
  </nav>
  <button class="header-cta" onclick="scrollToSection('products')"><i class="fas fa-shopping-bag" style="margin-right:6px;font-size:0.75rem;"></i>Shop Now</button>
  <div class="hamburger" id="hamburger" onclick="toggleMobileNav()">
    <span></span><span></span><span></span>
  </div>
</header>

<!-- ════ HERO ════ -->
<section class="hero">
  <div class="hero-bg-glow"></div>
  <div class="hero-bg-glow-2"></div>
  <div class="hero-inner">
    <div class="hero-content">
      <div class="hero-badge"><i class="fas fa-sparkles"></i> Introducing LuxeProduct 2026</div>
      <h1 class="hero-title">
        Experience <span class="gradient-text">Products</span><br>
        in Full <span class="gold-text">360°</span>
      </h1>
      <p class="hero-desc">Rotate, zoom, and explore every detail before you buy. Our immersive 360° viewer brings your product experience to life — right in your browser.</p>
      <div class="hero-actions">
        <button class="btn-primary" onclick="scrollToSection('products')"><i class="fas fa-circle-play"></i> View Collection</button>
        <button class="btn-ghost" onclick="scrollToSection('features')"><i class="fas fa-cube"></i> How It Works</button>
      </div>
      <div class="hero-stats">
        <div class="stat-item"><span class="stat-num">360°</span><span class="stat-label">Interactive View</span></div>
        <div class="stat-item"><span class="stat-num">50+</span><span class="stat-label">Products</span></div>
        <div class="stat-item"><span class="stat-num">4K</span><span class="stat-label">Resolution</span></div>
      </div>
    </div>

    <!-- 360 Viewer Card -->
    <div class="viewer-wrap">
      <div class="viewer-card">
        <div class="viewer-header">
          <div class="viewer-dots"><span></span><span></span><span></span></div>
          <div class="viewer-label"><i class="fas fa-circle" style="font-size:0.5rem;color:#28CA41;"></i>360° Live Preview</div>
          <div style="font-size:0.7rem;color:var(--text-muted);">Drag to rotate</div>
        </div>
        <div class="viewer-canvas" id="heroCanvas">
          <div class="product-stage">
            <div class="product-svg-wrap" id="heroProduct">
              <!-- Dynamic Product SVG -->
              <svg viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg" id="heroSVG">
                <!-- Watch base -->
                <defs>
                  <linearGradient id="watchGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#8B5CF6"/>
                    <stop offset="100%" style="stop-color:#C084FC"/>
                  </linearGradient>
                  <linearGradient id="watchBody" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#1E1B4B"/>
                    <stop offset="100%" style="stop-color:#312E81"/>
                  </linearGradient>
                  <filter id="glow">
                    <feGaussianBlur stdDeviation="3" result="coloredBlur"/>
                    <feMerge><feMergeNode in="coloredBlur"/><feMergeNode in="SourceGraphic"/></feMerge>
                  </filter>
                </defs>
                <!-- Watch strap top -->
                <rect x="118" y="20" width="64" height="55" rx="10" fill="#0F0F1A"/>
                <rect x="124" y="24" width="52" height="47" rx="8" fill="#1A1A2E"/>
                <!-- Watch strap bottom -->
                <rect x="118" y="225" width="64" height="55" rx="10" fill="#0F0F1A"/>
                <rect x="124" y="229" width="52" height="47" rx="8" fill="#1A1A2E"/>
                <!-- Watch body -->
                <rect x="75" y="70" width="150" height="160" rx="36" fill="url(#watchBody)" filter="url(#glow)"/>
                <rect x="79" y="74" width="142" height="152" rx="33" fill="#16133A"/>
                <!-- Screen -->
                <rect x="92" y="87" width="116" height="126" rx="24" fill="#080820"/>
                <!-- Screen glow -->
                <rect x="92" y="87" width="116" height="126" rx="24" fill="url(#watchGrad)" opacity="0.07"/>
                <!-- Time display -->
                <text x="150" y="138" text-anchor="middle" fill="white" font-size="28" font-weight="bold" font-family="'Syne',sans-serif">10:09</text>
                <text x="150" y="158" text-anchor="middle" fill="#A78BFA" font-size="10" font-family="'DM Sans',sans-serif">MON, 19 MAY</text>
                <!-- Steps bar -->
                <rect x="108" y="172" width="84" height="6" rx="3" fill="#1E1B4B"/>
                <rect x="108" y="172" width="54" height="6" rx="3" fill="url(#watchGrad)"/>
                <text x="150" y="195" text-anchor="middle" fill="#6B7280" font-size="8" font-family="'DM Sans',sans-serif">8,453 steps</text>
                <!-- Crown button -->
                <rect x="225" y="128" width="14" height="22" rx="5" fill="#1A1A2E" stroke="#8B5CF6" stroke-width="1.5"/>
                <!-- Bottom button -->
                <rect x="225" y="158" width="14" height="14" rx="4" fill="#1A1A2E" stroke="rgba(139,92,246,0.4)" stroke-width="1"/>
                <!-- Bezel accent -->
                <rect x="75" y="70" width="150" height="160" rx="36" fill="none" stroke="url(#watchGrad)" stroke-width="1.5" opacity="0.6"/>
              </svg>
            </div>
            <div class="product-shadow" id="heroShadow"></div>
          </div>
          <div class="viewer-float-badge">
            <div class="badge-360">360°</div>
            <div class="badge-sub">Interactive</div>
          </div>
          <div class="color-selector">
            <div class="color-dot active" data-color="purple" onclick="changeHeroColor(this,'watchBody','#1E1B4B','#312E81','#8B5CF6','#C084FC')"></div>
            <div class="color-dot" data-color="gold" onclick="changeHeroColor(this,'watchBody','#1C1400','#2D1F00','#F59E0B','#FDE68A')"></div>
            <div class="color-dot" data-color="cyan" onclick="changeHeroColor(this,'watchBody','#00181C','#002026','#06B6D4','#67E8F9')"></div>
            <div class="color-dot" data-color="rose" onclick="changeHeroColor(this,'watchBody','#1C0010','#2D0018','#F43F5E','#FB7185')"></div>
          </div>
          <div class="grab-label" id="grabLabel"><i class="fas fa-hand-pointer"></i> Drag to rotate</div>
        </div>
        <div class="viewer-controls">
          <div class="ctrl-group">
            <button class="ctrl-btn" onclick="zoomViewer(-10)" title="Zoom out"><i class="fas fa-minus"></i></button>
            <span class="zoom-display" id="zoomDisplay">100%</span>
            <button class="ctrl-btn" onclick="zoomViewer(10)" title="Zoom in"><i class="fas fa-plus"></i></button>
          </div>
          <div class="ctrl-group">
            <button class="ctrl-btn" id="autoRotateBtn" onclick="toggleAutoRotate()" title="Auto rotate"><i class="fas fa-rotate"></i></button>
            <button class="ctrl-btn" onclick="resetViewer()" title="Reset"><i class="fas fa-arrows-rotate"></i></button>
          </div>
          <div style="font-size:0.7rem;color:var(--text-muted);">
            <span id="angleDisplay">0°</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ════ FEATURES ════ -->
<section id="features">
  <div class="section-eyebrow">Why Choose Us</div>
  <h2 class="section-title">Built for the <span>Future</span> of Shopping</h2>
  <p class="section-desc">Experience products like never before. Our 360° technology gives you the confidence to buy without guessing.</p>
  <div class="features-grid">
    <div class="feature-card"><div class="feature-icon"><i class="fas fa-rotate"></i></div><h3>360° Rotation</h3><p>Drag, spin, and inspect every angle of the product with buttery-smooth 60fps rotation.</p></div>
    <div class="feature-card"><div class="feature-icon"><i class="fas fa-magnifying-glass-plus"></i></div><h3>Deep Zoom</h3><p>Zoom in up to 4x to examine textures, stitching, and fine details that matter most.</p></div>
    <div class="feature-card"><div class="feature-icon"><i class="fas fa-palette"></i></div><h3>Color Variants</h3><p>Switch between all available colorways in real-time without leaving the viewer.</p></div>
    <div class="feature-card"><div class="feature-icon"><i class="fas fa-cube"></i></div><h3>3D Model Ready</h3><p>Full photogrammetry-quality 3D models reconstructed from studio photography.</p></div>
    <div class="feature-card"><div class="feature-icon"><i class="fas fa-bolt"></i></div><h3>Instant Load</h3><p>Progressive loading ensures your 360° experience starts in under 200ms on any device.</p></div>
    <div class="feature-card"><div class="feature-icon"><i class="fas fa-mobile-screen"></i></div><h3>Mobile Native</h3><p>Touch-drag on mobile works exactly like mouse-drag on desktop — one seamless experience.</p></div>
  </div>
</section>

<!-- ════ PRODUCTS ════ -->
<div class="products-section" id="products">
  <div class="products-wrap">
    <div class="section-eyebrow">Our Collection</div>
    <h2 class="section-title">Explore <span>Every Product</span> in 360°</h2>
    <p class="section-desc">Click any product to open the full interactive viewer. Rotate, zoom, and inspect before you decide.</p>
    <div class="filter-bar">
      <button class="filter-pill active" data-cat="all" onclick="filterProducts(this)">All</button>
      <button class="filter-pill" data-cat="watch" onclick="filterProducts(this)">Watches</button>
      <button class="filter-pill" data-cat="bag" onclick="filterProducts(this)">Bags</button>
      <button class="filter-pill" data-cat="shoe" onclick="filterProducts(this)">Shoes</button>
      <button class="filter-pill" data-cat="tech" onclick="filterProducts(this)">Tech</button>
    </div>
    <div class="products-grid" id="productsGrid"></div>
  </div>
</div>

<!-- ════ TESTIMONIALS ════ -->
<div class="testimonials-section" id="reviews">
  <div class="testimonials-wrap">
    <div class="section-eyebrow">Customer Love</div>
    <h2 class="section-title">What Our <span>Customers</span> Say</h2>
    <div class="testimonials-grid">
      <div class="testimonial-card"><div class="stars">★★★★★</div><p class="testimonial-text">"The 360° view was a game changer. I could see every detail of the watch — the bezel, the clasp, the strap texture. Bought it without hesitation."</p><div class="testimonial-author"><div class="author-avatar">RK</div><div><div class="author-name">Rajan Kumar</div><div class="author-role">Verified Buyer · Watch</div></div></div></div>
      <div class="testimonial-card"><div class="stars">★★★★★</div><p class="testimonial-text">"Being able to spin the bag and zoom into the stitching and zipper quality gave me so much confidence. Absolutely premium experience."</p><div class="testimonial-author"><div class="author-avatar">SL</div><div><div class="author-name">Sneha Lakshmi</div><div class="author-role">Verified Buyer · Bag</div></div></div></div>
      <div class="testimonial-card"><div class="stars">★★★★★</div><p class="testimonial-text">"Never returning to static photos again. The color switcher in the viewer is brilliant — saw all 5 variants before picking the right one."</p><div class="testimonial-author"><div class="author-avatar">AP</div><div><div class="author-name">Arjun Pillai</div><div class="author-role">Verified Buyer · Sneakers</div></div></div></div>
    </div>
  </div>
</div>

<!-- ════ CTA ════ -->
<div class="cta-section" id="contact">
  <div class="cta-inner">
    <div class="section-eyebrow" style="justify-content:center;">Limited Offer</div>
    <h2>Ready to <span style="background:var(--accent-gradient);-webkit-background-clip:text;background-clip:text;color:transparent;">Experience</span> the Difference?</h2>
    <p class="section-desc" style="margin:1rem auto 2rem;max-width:480px;text-align:center;">Join 50,000+ customers who shop smarter with our 360° interactive product viewer.</p>
    <div class="cta-btns">
      <button class="btn-primary" onclick="scrollToSection('products')"><i class="fas fa-shopping-bag"></i> Shop Collection</button>
      <button class="btn-ghost"><i class="fas fa-envelope"></i> Contact Us</button>
    </div>
  </div>
</div>

<!-- ════ FOOTER ════ -->
<footer>
  <div class="footer-logo">LUXE<sup style="font-size:0.5em;vertical-align:super;">®</sup></div>
  <div class="footer-links">
    <a href="#">Privacy Policy</a>
    <a href="#">Terms of Service</a>
    <a href="#">Returns</a>
    <a href="#">Support</a>
  </div>
  <div class="footer-copy">© 2026 LuxeProduct. All rights reserved.</div>
</footer>

<!-- ════ 360° PRODUCT MODAL ════ -->
<div class="modal-overlay" id="productModal">
  <div class="modal-box">
    <div class="modal-top">
      <div class="modal-title" id="modalProductName">Product Name</div>
      <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
    </div>
    <div class="modal-body">
      <div class="modal-viewer">
        <div class="rotation-ring">
          <div class="rotation-dot" id="rotationDot"></div>
        </div>
        <div class="modal-viewer-inner">
          <div class="modal-product-svg" id="modalProductSVG">
            <!-- SVG injected dynamically -->
          </div>
        </div>
        <div class="modal-grab-hint"><i class="fas fa-hand-pointer"></i> Drag left/right to rotate</div>
        <button class="modal-spin-btn" id="modalSpinBtn" onclick="toggleModalAutoSpin()"><i class="fas fa-rotate"></i> Auto Spin</button>
      </div>
      <div class="modal-sidebar" id="modalSidebar">
        <!-- Sidebar content injected -->
      </div>
    </div>
  </div>
</div>

<!-- Toast -->
<div class="toast" id="toast"><i class="fas fa-circle-check"></i><span id="toastMsg"></span></div>

<script>
/* ══════════════════════════════════════════
   PRODUCT DATA
══════════════════════════════════════════ */
const products = [
  {
    id:1, cat:'watch', brand:'LuxeTime', name:'Apex Pro Watch', desc:'Premium smartwatch with health tracking, AMOLED display, and aerospace-grade titanium case.',
    price:'₹24,999', colors:['purple','gold','cyan','rose','black'],
    specs:[{k:'Material',v:'Titanium Case'},{k:'Display',v:'1.9" AMOLED'},{k:'Battery',v:'7 Days'},{k:'Rating',v:'IP68 Water'}],
    tag:'Best Seller', svgType:'watch'
  },
  {
    id:2, cat:'bag', brand:'LuxeCarry', name:'Velocity Tote', desc:'Hand-stitched full-grain leather tote with anti-scratch lining and hidden magnetic closure.',
    price:'₹18,499', colors:['black','gold','rose'],
    specs:[{k:'Material',v:'Full-grain Leather'},{k:'Capacity',v:'18L'},{k:'Strap',v:'Detachable'},{k:'Warranty',v:'2 Years'}],
    tag:'New Arrival', svgType:'bag'
  },
  {
    id:3, cat:'shoe', brand:'LuxeStep', name:'Cloud Runner X', desc:'Ultra-lightweight performance sneaker with responsive foam midsole and breathable mesh upper.',
    price:'₹12,999', colors:['purple','cyan','rose','black'],
    specs:[{k:'Upper',v:'Knit Mesh'},{k:'Sole',v:'React Foam'},{k:'Weight',v:'240g'},{k:'Drop',v:'8mm Heel'}],
    tag:'Limited Edition', svgType:'shoe'
  },
  {
    id:4, cat:'tech', brand:'LuxeTech', name:'AirBuds Ultra', desc:'Active noise cancelling earbuds with 32hr total battery, spatial audio, and custom EQ tuning.',
    price:'₹9,999', colors:['black','white-ish','purple','cyan'],
    specs:[{k:'Driver',v:'10mm Dynamic'},{k:'ANC',v:'-40dB'},{k:'Battery',v:'8+24hr'},{k:'Codec',v:'LDAC / AAC'}],
    tag:'Top Rated', svgType:'buds'
  },
  {
    id:5, cat:'watch', brand:'LuxeTime', name:'Chrono Elite', desc:'Swiss-inspired mechanical watch with sapphire crystal glass, exhibition caseback and 80hr power reserve.',
    price:'₹42,000', colors:['gold','black','cyan'],
    specs:[{k:'Movement',v:'Automatic'},{k:'Crystal',v:'Sapphire'},{k:'Power',v:'80 Hours'},{k:'Case',v:'40mm Steel'}],
    tag:'Premium', svgType:'watch2'
  },
  {
    id:6, cat:'bag', brand:'LuxeCarry', name:'Summit Backpack', desc:'Water-resistant nylon backpack with laptop compartment, ergonomic straps, and modular organization.',
    price:'₹7,499', colors:['black','cyan','purple'],
    specs:[{k:'Material',v:'900D Nylon'},{k:'Capacity',v:'28L'},{k:'Laptop',v:'Up to 16"'},{k:'Pockets',v:'8 Compartments'}],
    tag:'Trending', svgType:'backpack'
  }
];

/* ══════════════════════════════════════════
   SVG GENERATORS
══════════════════════════════════════════ */
function getSVG(type, colorScheme='purple'){
  const cols = {
    purple:{b1:'#1E1B4B',b2:'#312E81',a1:'#8B5CF6',a2:'#C084FC'},
    gold:{b1:'#1C1400',b2:'#2D1F00',a1:'#F59E0B',a2:'#FDE68A'},
    cyan:{b1:'#00181C',b2:'#002026',a1:'#06B6D4',a2:'#67E8F9'},
    rose:{b1:'#1C0010',b2:'#2D0018',a1:'#F43F5E',a2:'#FB7185'},
    black:{b1:'#0A0A0A',b2:'#1A1A1A',a1:'#64748B',a2:'#94A3B8'},
    'white-ish':{b1:'#F8F8F0',b2:'#E8E8E0',a1:'#6B7280',a2:'#9CA3AF'},
  };
  const c = cols[colorScheme] || cols.purple;

  if(type==='watch'||type==='watch2'){
    return `<svg viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="wg${type}" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" style="stop-color:${c.a1}"/><stop offset="100%" style="stop-color:${c.a2}"/>
        </linearGradient>
        <linearGradient id="wb${type}" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" style="stop-color:${c.b1}"/><stop offset="100%" style="stop-color:${c.b2}"/>
        </linearGradient>
        <filter id="gf${type}"><feGaussianBlur stdDeviation="3" result="b"/><feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge></filter>
      </defs>
      <rect x="118" y="20" width="64" height="55" rx="10" fill="${c.b1}"/>
      <rect x="124" y="24" width="52" height="47" rx="8" fill="${c.b2}"/>
      <rect x="118" y="225" width="64" height="55" rx="10" fill="${c.b1}"/>
      <rect x="124" y="229" width="52" height="47" rx="8" fill="${c.b2}"/>
      <rect x="75" y="70" width="150" height="160" rx="36" fill="url(#wb${type})" filter="url(#gf${type})"/>
      <rect x="79" y="74" width="142" height="152" rx="33" fill="${c.b2}"/>
      <rect x="92" y="87" width="116" height="126" rx="24" fill="#080820"/>
      <rect x="92" y="87" width="116" height="126" rx="24" fill="url(#wg${type})" opacity="0.07"/>
      <text x="150" y="138" text-anchor="middle" fill="white" font-size="28" font-weight="bold" font-family="sans-serif">10:09</text>
      <text x="150" y="158" text-anchor="middle" fill="${c.a1}" font-size="10" font-family="sans-serif">MON, 19 MAY</text>
      <rect x="108" y="172" width="84" height="6" rx="3" fill="${c.b1}"/>
      <rect x="108" y="172" width="54" height="6" rx="3" fill="url(#wg${type})"/>
      <text x="150" y="195" text-anchor="middle" fill="#6B7280" font-size="8" font-family="sans-serif">8,453 steps</text>
      <rect x="225" y="128" width="14" height="22" rx="5" fill="${c.b2}" stroke="${c.a1}" stroke-width="1.5"/>
      <rect x="225" y="158" width="14" height="14" rx="4" fill="${c.b2}" stroke="${c.a1}" stroke-width="1" opacity="0.5"/>
      <rect x="75" y="70" width="150" height="160" rx="36" fill="none" stroke="url(#wg${type})" stroke-width="1.5" opacity="0.6"/>
    </svg>`;
  }

  if(type==='bag'){
    return `<svg viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="bgg${type}" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" style="stop-color:${c.a1}"/><stop offset="100%" style="stop-color:${c.a2}"/>
        </linearGradient>
      </defs>
      <!-- Handle -->
      <path d="M110 95 Q110 55 150 55 Q190 55 190 95" fill="none" stroke="${c.a1}" stroke-width="10" stroke-linecap="round"/>
      <!-- Bag body -->
      <rect x="60" y="93" width="180" height="160" rx="20" fill="${c.b2}"/>
      <rect x="64" y="97" width="172" height="152" rx="18" fill="${c.b1}"/>
      <!-- Front pocket -->
      <rect x="80" y="130" width="140" height="90" rx="12" fill="${c.b2}" stroke="${c.a1}" stroke-width="0.8" stroke-opacity="0.4"/>
      <!-- Zip -->
      <line x1="90" y1="130" x2="210" y2="130" stroke="${c.a1}" stroke-width="2" stroke-linecap="round" opacity="0.6"/>
      <circle cx="150" cy="130" r="5" fill="${c.a1}" opacity="0.8"/>
      <!-- Logo area -->
      <circle cx="150" cy="175" r="22" fill="${c.b1}" stroke="${c.a1}" stroke-width="1.5" opacity="0.6"/>
      <text x="150" y="180" text-anchor="middle" fill="${c.a2}" font-size="12" font-weight="bold" font-family="sans-serif">L</text>
      <!-- Handle attachment -->
      <rect x="108" y="90" width="18" height="12" rx="4" fill="${c.a1}" opacity="0.7"/>
      <rect x="174" y="90" width="18" height="12" rx="4" fill="${c.a1}" opacity="0.7"/>
    </svg>`;
  }

  if(type==='shoe'){
    return `<svg viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="sg${type}" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" style="stop-color:${c.a1}"/><stop offset="100%" style="stop-color:${c.a2}"/>
        </linearGradient>
      </defs>
      <!-- Sole -->
      <path d="M50 220 Q52 240 100 245 L250 242 Q270 240 268 228 Q265 218 240 216 L50 220Z" fill="${c.a1}" opacity="0.9"/>
      <!-- Midsole -->
      <path d="M50 220 L240 216 Q260 214 258 206 Q255 198 230 196 L70 200 Q52 202 50 212Z" fill="${c.b2}"/>
      <!-- Upper -->
      <path d="M70 200 L80 155 Q90 130 120 120 L185 115 Q220 112 240 135 L248 196 L230 196 L70 200Z" fill="${c.b1}"/>
      <!-- Upper detail -->
      <path d="M80 155 L90 130 Q100 118 130 115" fill="none" stroke="${c.a1}" stroke-width="1.5" opacity="0.5"/>
      <!-- Laces -->
      <line x1="115" y1="140" x2="185" y2="137" stroke="white" stroke-width="2" stroke-linecap="round" opacity="0.7"/>
      <line x1="117" y1="152" x2="187" y2="149" stroke="white" stroke-width="2" stroke-linecap="round" opacity="0.7"/>
      <line x1="120" y1="163" x2="190" y2="160" stroke="white" stroke-width="2" stroke-linecap="round" opacity="0.7"/>
      <!-- Swoosh accent -->
      <path d="M90 175 Q140 155 215 168" fill="none" stroke="${c.a2}" stroke-width="3" stroke-linecap="round" opacity="0.6"/>
      <!-- Heel -->
      <path d="M230 135 Q250 140 248 196 L230 196 Z" fill="${c.b2}" opacity="0.8"/>
      <text x="150" y="235" text-anchor="middle" fill="white" font-size="7" font-family="sans-serif" opacity="0.6">LUXE STEP</text>
    </svg>`;
  }

  if(type==='buds'){
    return `<svg viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="bdg${type}" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" style="stop-color:${c.a1}"/><stop offset="100%" style="stop-color:${c.a2}"/>
        </linearGradient>
      </defs>
      <!-- Case body -->
      <rect x="75" y="90" width="150" height="120" rx="30" fill="${c.b2}"/>
      <rect x="79" y="94" width="142" height="112" rx="28" fill="${c.b1}"/>
      <!-- Lid line -->
      <line x1="79" y1="150" x2="221" y2="150" stroke="${c.a1}" stroke-width="0.8" opacity="0.4"/>
      <!-- Left bud cutout -->
      <ellipse cx="117" cy="140" rx="22" ry="28" fill="${c.b2}" stroke="${c.a1}" stroke-width="0.8" opacity="0.5"/>
      <ellipse cx="117" cy="140" rx="16" ry="22" fill="#080820"/>
      <circle cx="117" cy="140" r="6" fill="${c.a1}" opacity="0.5"/>
      <!-- Right bud cutout -->
      <ellipse cx="183" cy="140" rx="22" ry="28" fill="${c.b2}" stroke="${c.a1}" stroke-width="0.8" opacity="0.5"/>
      <ellipse cx="183" cy="140" rx="16" ry="22" fill="#080820"/>
      <circle cx="183" cy="140" r="6" fill="${c.a1}" opacity="0.5"/>
      <!-- Battery dots -->
      <circle cx="136" cy="195" r="4" fill="${c.a1}" opacity="0.9"/>
      <circle cx="150" cy="195" r="4" fill="${c.a1}" opacity="0.5"/>
      <circle cx="164" cy="195" r="4" fill="${c.a1}" opacity="0.3"/>
      <!-- Hinge -->
      <rect x="138" y="87" width="24" height="8" rx="4" fill="${c.a1}" opacity="0.4"/>
      <!-- Case border -->
      <rect x="75" y="90" width="150" height="120" rx="30" fill="none" stroke="${c.a1}" stroke-width="1" opacity="0.4"/>
    </svg>`;
  }

  if(type==='backpack'){
    return `<svg viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="bpg${type}" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" style="stop-color:${c.a1}"/><stop offset="100%" style="stop-color:${c.a2}"/>
        </linearGradient>
      </defs>
      <!-- Strap top -->
      <path d="M130 65 Q128 45 150 42 Q172 45 170 65" fill="none" stroke="${c.a1}" stroke-width="8" stroke-linecap="round"/>
      <!-- Main body -->
      <rect x="60" y="65" width="180" height="195" rx="22" fill="${c.b2}"/>
      <rect x="64" y="69" width="172" height="187" rx="20" fill="${c.b1}"/>
      <!-- Front zip pocket -->
      <rect x="75" y="170" width="150" height="80" rx="14" fill="${c.b2}" stroke="${c.a1}" stroke-width="0.8" stroke-opacity="0.4"/>
      <!-- Top zip -->
      <path d="M76 170 Q150 158 224 170" fill="none" stroke="${c.a1}" stroke-width="2" opacity="0.6"/>
      <circle cx="150" cy="164" r="5" fill="${c.a1}" opacity="0.8"/>
      <!-- Main zip -->
      <path d="M73 170 Q150 75 227 170" fill="none" stroke="${c.a1}" stroke-width="1.5" opacity="0.3"/>
      <!-- Logo -->
      <circle cx="150" cy="120" r="28" fill="${c.b2}" stroke="${c.a1}" stroke-width="1.5" opacity="0.5"/>
      <text x="150" y="126" text-anchor="middle" fill="${c.a2}" font-size="16" font-weight="bold" font-family="sans-serif">L</text>
      <!-- Side straps -->
      <rect x="60" y="100" width="12" height="100" rx="6" fill="${c.b2}" stroke="${c.a1}" stroke-width="0.5" opacity="0.4"/>
      <rect x="228" y="100" width="12" height="100" rx="6" fill="${c.b2}" stroke="${c.a1}" stroke-width="0.5" opacity="0.4"/>
    </svg>`;
  }
  return `<svg viewBox="0 0 300 300"><text x="150" y="150" text-anchor="middle" fill="white">Product</text></svg>`;
}

/* ══════════════════════════════════════════
   HERO 360° VIEWER
══════════════════════════════════════════ */
let heroAngle=0, heroDragging=false, heroLastX=0, heroAutoRotate=false, heroRAF=null, heroZoom=100;
let heroColorScheme='purple';

const heroCanvas = document.getElementById('heroCanvas');
const heroProduct = document.getElementById('heroProduct');
const grabLabel = document.getElementById('grabLabel');
const angleDisplay = document.getElementById('angleDisplay');
const zoomDisplay = document.getElementById('zoomDisplay');

function applyHeroTransform(){
  heroProduct.style.transform = `scale(${heroZoom/100}) perspective(600px) rotateY(${heroAngle}deg)`;
  angleDisplay.textContent = Math.round(((heroAngle%360)+360)%360)+'°';
  // shadow width based on perspective
  const pct = 50 + 15*Math.sin(heroAngle * Math.PI/180);
  const shadow = document.getElementById('heroShadow');
  if(shadow) shadow.style.width = pct+'%';
}

heroCanvas.addEventListener('mousedown', e=>{ heroDragging=true; heroLastX=e.clientX; stopAutoRotate(); grabLabel.classList.add('hide'); heroCanvas.style.cursor='grabbing'; });
heroCanvas.addEventListener('mousemove', e=>{ if(!heroDragging) return; heroAngle += (e.clientX - heroLastX)*0.5; heroLastX=e.clientX; applyHeroTransform(); });
document.addEventListener('mouseup', ()=>{ heroDragging=false; heroCanvas.style.cursor='grab'; });

heroCanvas.addEventListener('touchstart', e=>{ heroDragging=true; heroLastX=e.touches[0].clientX; stopAutoRotate(); grabLabel.classList.add('hide'); }, {passive:true});
heroCanvas.addEventListener('touchmove', e=>{ if(!heroDragging) return; heroAngle += (e.touches[0].clientX - heroLastX)*0.5; heroLastX=e.touches[0].clientX; applyHeroTransform(); }, {passive:true});
document.addEventListener('touchend', ()=>{ heroDragging=false; });

heroCanvas.style.cursor='grab';

function startAutoRotate(){
  heroAutoRotate=true;
  document.getElementById('autoRotateBtn').classList.add('active');
  function loop(){ if(!heroAutoRotate) return; if(!heroDragging){ heroAngle+=0.4; applyHeroTransform(); } heroRAF=requestAnimationFrame(loop); }
  loop();
}
function stopAutoRotate(){
  heroAutoRotate=false;
  document.getElementById('autoRotateBtn').classList.remove('active');
  cancelAnimationFrame(heroRAF);
}
function toggleAutoRotate(){ if(heroAutoRotate) stopAutoRotate(); else startAutoRotate(); }
function resetViewer(){ heroAngle=0; heroZoom=100; applyHeroTransform(); zoomDisplay.textContent='100%'; }
function zoomViewer(delta){ heroZoom=Math.min(200,Math.max(50,heroZoom+delta)); zoomDisplay.textContent=heroZoom+'%'; applyHeroTransform(); }
function changeHeroColor(el){ document.querySelectorAll('.color-dot').forEach(d=>d.classList.remove('active')); el.classList.add('active'); heroColorScheme=el.dataset.color; document.getElementById('heroSVG').outerHTML; const wrap=document.getElementById('heroProduct'); const newSVG=getSVG('watch',heroColorScheme); wrap.innerHTML=newSVG; applyHeroTransform(); }

// Start auto rotate on load
setTimeout(startAutoRotate, 800);

/* ══════════════════════════════════════════
   PRODUCTS GRID
══════════════════════════════════════════ */
function renderProducts(filter='all'){
  const grid=document.getElementById('productsGrid');
  const filtered = filter==='all' ? products : products.filter(p=>p.cat===filter);
  grid.innerHTML='';
  filtered.forEach(p=>{
    const card=document.createElement('div');
    card.className='product-card';
    card.innerHTML=`
      <div class="product-thumb" style="background:radial-gradient(ellipse at 50% 60%,${getColorGlow(p.colors[0])},var(--bg-card));">
        ${getSVG(p.svgType, p.colors[0])}
        <div class="thumb-tag">${p.tag}</div>
        <div class="thumb-360"><i class="fas fa-rotate"></i> 360° View</div>
      </div>
      <div class="product-info">
        <div class="product-brand">${p.brand}</div>
        <div class="product-name">${p.name}</div>
        <div class="product-desc">${p.desc}</div>
        <div class="product-footer">
          <div class="product-price">${p.price}</div>
          <button class="btn-view">View 360°</button>
        </div>
      </div>`;
    card.onclick=()=>openModal(p);
    grid.appendChild(card);
  });
}

function getColorGlow(c){
  const map={purple:'rgba(139,92,246,0.1)',gold:'rgba(245,158,11,0.1)',cyan:'rgba(6,182,212,0.1)',rose:'rgba(244,63,94,0.1)',black:'rgba(100,116,139,0.08)','white-ish':'rgba(255,255,255,0.05)'};
  return map[c]||'rgba(139,92,246,0.08)';
}

function filterProducts(btn){
  document.querySelectorAll('.filter-pill').forEach(b=>b.classList.remove('active'));
  btn.classList.add('active');
  renderProducts(btn.dataset.cat);
}

renderProducts();

/* ══════════════════════════════════════════
   MODAL 360° VIEWER
══════════════════════════════════════════ */
let modalAngle=0, modalDragging=false, modalLastX=0, modalAutoSpin=false, modalRAF2=null;
let currentProduct=null, currentModalColor=null;

const modal=document.getElementById('productModal');
const modalSVGContainer=document.getElementById('modalProductSVG');
const rotDot=document.getElementById('rotationDot');

function openModal(p){
  currentProduct=p;
  currentModalColor=p.colors[0];
  modalAngle=0;
  document.getElementById('modalProductName').textContent=p.name;
  renderModalSVG();
  renderModalSidebar(p);
  modal.classList.add('show');
  document.body.style.overflow='hidden';
  setTimeout(()=>{ if(!modalAutoSpin) toggleModalAutoSpin(); }, 300);
}

function renderModalSVG(){
  modalSVGContainer.innerHTML=getSVG(currentProduct.svgType, currentModalColor);
  applyModalTransform();
}

function renderModalSidebar(p){
  const colorDots = p.colors.map(c=>`<div class="ms-color-dot ${c} ${c===p.colors[0]?'active':''}" data-color="${c}" onclick="changeModalColor(this,'${c}')"></div>`).join('');
  const specs = p.specs.map(s=>`<div class="spec-row"><span class="spec-key">${s.k}</span><span class="spec-val">${s.v}</span></div>`).join('');
  document.getElementById('modalSidebar').innerHTML=`
    <div class="ms-brand">${p.brand}</div>
    <div class="ms-name">${p.name}</div>
    <div class="ms-desc">${p.desc}</div>
    <div class="ms-price">${p.price}</div>
    <div class="ms-divider"></div>
    <div class="ms-label">Color</div>
    <div class="ms-colors">${colorDots}</div>
    <div class="ms-divider"></div>
    <div class="ms-label">Specifications</div>
    <div class="ms-specs">${specs}</div>
    <div class="ms-actions">
      <button class="btn-buy" onclick="showToast('Added to cart!')"><i class="fas fa-shopping-bag" style="margin-right:6px;"></i>Add to Cart</button>
      <button class="btn-wishlist"><i class="fas fa-heart"></i> Save to Wishlist</button>
    </div>`;
}

function changeModalColor(el, color){
  document.querySelectorAll('.ms-color-dot').forEach(d=>d.classList.remove('active'));
  el.classList.add('active');
  currentModalColor=color;
  renderModalSVG();
}

function applyModalTransform(){
  modalSVGContainer.style.transform=`perspective(700px) rotateY(${modalAngle}deg)`;
  // rotate the dot indicator
  const angle = modalAngle*Math.PI/180;
  const r=44; // percent radius
  rotDot.style.top=(50 - r*Math.cos(angle))+'%';
  rotDot.style.left=(50 + r*Math.sin(angle))+'%';
  rotDot.style.transform='translate(-50%,-50%)';
}

const modalViewer = document.querySelector('.modal-viewer');
modalViewer.addEventListener('mousedown', e=>{ modalDragging=true; modalLastX=e.clientX; stopModalSpin(); modalViewer.style.cursor='grabbing'; });
modalViewer.addEventListener('mousemove', e=>{ if(!modalDragging) return; modalAngle+=(e.clientX-modalLastX)*0.5; modalLastX=e.clientX; applyModalTransform(); });
document.addEventListener('mouseup', ()=>{ modalDragging=false; if(modalViewer) modalViewer.style.cursor='grab'; });
modalViewer.addEventListener('touchstart', e=>{ modalDragging=true; modalLastX=e.touches[0].clientX; stopModalSpin(); }, {passive:true});
modalViewer.addEventListener('touchmove', e=>{ if(!modalDragging) return; modalAngle+=(e.touches[0].clientX-modalLastX)*0.5; modalLastX=e.touches[0].clientX; applyModalTransform(); }, {passive:true});
document.addEventListener('touchend', ()=>{ modalDragging=false; });
modalViewer.style.cursor='grab';

function toggleModalAutoSpin(){
  if(modalAutoSpin) stopModalSpin(); else startModalSpin();
}
function startModalSpin(){
  modalAutoSpin=true;
  document.getElementById('modalSpinBtn').classList.add('spinning');
  document.getElementById('modalSpinBtn').innerHTML='<i class="fas fa-pause"></i> Pause';
  function loop(){ if(!modalAutoSpin) return; if(!modalDragging){ modalAngle+=0.5; applyModalTransform(); } modalRAF2=requestAnimationFrame(loop); }
  loop();
}
function stopModalSpin(){
  modalAutoSpin=false;
  cancelAnimationFrame(modalRAF2);
  const btn=document.getElementById('modalSpinBtn');
  if(btn){ btn.classList.remove('spinning'); btn.innerHTML='<i class="fas fa-rotate"></i> Auto Spin'; }
}
function closeModal(){
  stopModalSpin();
  modal.classList.remove('show');
  document.body.style.overflow='';
  showToast('Viewer closed');
}

// Close on backdrop
modal.addEventListener('click', e=>{ if(e.target===modal) closeModal(); });

/* ══════════════════════════════════════════
   CURSOR
══════════════════════════════════════════ */
const cursor=document.getElementById('cursor');
const cursorRing=document.getElementById('cursorRing');
let cx=0,cy=0,rx=0,ry=0;
document.addEventListener('mousemove', e=>{ cx=e.clientX; cy=e.clientY; cursor.style.left=cx+'px'; cursor.style.top=cy+'px'; });
(function animRing(){ rx+=(cx-rx)*0.12; ry+=(cy-ry)*0.12; cursorRing.style.left=(rx-18)+'px'; cursorRing.style.top=(ry-18)+'px'; requestAnimationFrame(animRing); })();

document.querySelectorAll('button,a,.product-card,.ctrl-btn,.color-dot,.ms-color-dot,.filter-pill').forEach(el=>{
  el.addEventListener('mouseenter',()=>{ cursor.style.transform='scale(2.5)'; cursor.style.background='var(--accent-soft)'; cursorRing.style.transform='scale(1.5)'; cursor.style.mixBlendMode='normal'; });
  el.addEventListener('mouseleave',()=>{ cursor.style.transform='scale(1)'; cursor.style.background='var(--accent)'; cursorRing.style.transform='scale(1)'; cursor.style.mixBlendMode='screen'; });
});

/* ══════════════════════════════════════════
   MISC
══════════════════════════════════════════ */
function scrollToSection(id){ const el=document.getElementById(id); if(el) el.scrollIntoView({behavior:'smooth'}); }
function toggleMobileNav(){ document.getElementById('mobileNav').classList.add('show'); }
function closeMobileNav(){ document.getElementById('mobileNav').classList.remove('show'); }
document.getElementById('mobileClose').onclick=closeMobileNav;

function showToast(msg){
  const t=document.getElementById('toast');
  document.getElementById('toastMsg').textContent=msg;
  t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'),2500);
}

// Scroll-triggered fade in
const observer=new IntersectionObserver(entries=>{ entries.forEach(e=>{ if(e.isIntersecting){ e.target.style.opacity='1'; e.target.style.transform='translateY(0)'; } }); }, {threshold:0.1});
document.querySelectorAll('.feature-card,.product-card,.testimonial-card').forEach(el=>{ el.style.opacity='0'; el.style.transform='translateY(20px)'; el.style.transition='opacity 0.5s ease, transform 0.5s ease'; observer.observe(el); });

// Keyboard: Escape closes modal
document.addEventListener('keydown', e=>{ if(e.key==='Escape'&&modal.classList.contains('show')) closeModal(); });
</script>
</body>
</html>